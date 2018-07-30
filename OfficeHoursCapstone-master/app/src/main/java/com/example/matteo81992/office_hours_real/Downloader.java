/**
 * Created by Matt Lupino
 *
 * This class downloads all the information from our database about each professor. It then is sent
 * to the Parser class to be handled accordingly.
 */

package com.example.matteo81992.office_hours_real;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.widget.ListView;
import android.widget.Toast;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;



public class Downloader extends AsyncTask<Void, Integer, String> {

    Context c;
    String address;
    ListView lv;

    ProgressDialog pd;

    public Downloader(Context c, String address, ListView lv) {
        this.c = c;
        this.address = address;
        this.lv = lv;
    }

    @Override
    protected void onPreExecute() {
        super.onPreExecute();

        pd = new ProgressDialog(c);
        pd.setTitle("Fetch Data");
        pd.setMessage("Fetching data... Please wait.");
        pd.show();
    }


    @Override
    protected String doInBackground(Void... voids) {
        String data = null;
        try {
            data = downloadData();
        } catch (IOException e) {
            e.printStackTrace();
        }
        return data;
    }


    @Override
    protected void onPostExecute(String s) {
        super.onPostExecute(s);

        pd.dismiss();

        if (s != null) {
            Parser p = new Parser(c, lv, s);
            p.execute();
        } else {
            Toast.makeText(c, "Unable to download data", Toast.LENGTH_SHORT).show();
        }
    }

    // This is called in doInBackground. This is where the magic happens, so to speak.
    private String downloadData() throws IOException {
        // Connect and get a stream of data
        InputStream is = null;
        String line = null;

        try {
            URL url = new URL(address);

            HttpURLConnection con = (HttpURLConnection) url.openConnection();
            con.setConnectTimeout(5000);
            is = new BufferedInputStream(con.getInputStream());

            BufferedReader br = new BufferedReader(new InputStreamReader(is));

            StringBuffer sb = new StringBuffer();

            if (br != null) {
                while ((line = br.readLine()) != null) {
                    sb.append(line + "\n");
                }
            } else {
                return null;
            }

            return sb.toString();

        } catch (MalformedURLException e) {
            e.printStackTrace();
        } catch (java.net.SocketTimeoutException e) {
            Toast.makeText(c, "Connection timed out. Please refresh.",
                    Toast.LENGTH_SHORT).show();
        } catch (IOException e) {
            e.printStackTrace();
        } finally {
            if (is != null) {
                try {
                    is.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        }
        return null;
    }


}
