/**
 * Created by Matt Lupino
 *
 * Date: 4.16.18
 *
 * This class creates the main activity for the Office Hours app. In it,
 * you will find two classes and an Async Task.
 *
 */

package com.example.matteo81992.office_hours_real;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.os.Parcel;
import android.os.Parcelable;
import android.preference.PreferenceManager;
import android.support.annotation.RequiresApi;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.text.SpannableString;
import android.text.TextUtils;
import android.text.method.LinkMovementMethod;
import android.text.util.Linkify;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.SearchView;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import org.apache.commons.lang3.StringUtils;
import org.joda.time.DateTime;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.lang.reflect.Type;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import java.util.Date;

public class MainActivity extends AppCompatActivity implements SearchView.OnQueryTextListener {

    public static ArrayList<Professor> p = new ArrayList<>();
    public static ArrayList<Professor> pclone = (ArrayList<Professor>) p.clone();
    String url2 = "http://officehours-env.us-east-1.elasticbeanstalk.com/capstone/getHours.php";
    String url1 = "http://officehours-env.us-east-1.elasticbeanstalk.com/capstone/getProfessors.php";
    public static ListView lv;
    SearchView searchView;
    public static ProfessorAdapter adapter;
    Downloader d;
    static Spinner spinner;
    static ArrayAdapter<CharSequence> spinAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        SharedPreferences appSharedPrefs = PreferenceManager
                .getDefaultSharedPreferences(this.getApplicationContext());
        String json = appSharedPrefs.getString("Professors", "");


        setContentView(R.layout.activity_main);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        searchView = (SearchView) findViewById(R.id.enterProfName);


        setSupportActionBar(toolbar);
        lv = (ListView) findViewById(R.id.professorslist);

        if (savedInstanceState != null) {
            p = savedInstanceState.getParcelableArrayList("key");
            adapter = new ProfessorAdapter(this, p);
            lv.setAdapter(adapter);

        } else if (json.length() > 0) {
            Gson gson = new Gson();
            Type type = new TypeToken<ArrayList<Professor>>() {
            }.getType();
            p = gson.fromJson(json, type);
            adapter = new ProfessorAdapter(this, p);
            lv.setAdapter(adapter);
        }
        d = new Downloader(this, url1, lv);
        d.execute();
        DownloadHours downloadHours = new DownloadHours(this, url2);
        downloadHours.execute();

        lv.setTextFilterEnabled(false);

        // Formats the office hours information on the Alert Dialog
        lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                String title = "";
                String msg = "";
                Professor prof = (Professor) adapterView.getItemAtPosition(i);
                if (!prof.prefix.equals(""))
                    title = prof.prefix + " " + prof.getFullName();
                else
                    title = prof.getFullName();
                msg = "Office: " + prof.offBuilding + " " + prof.offNumber + "\n\nEmail: " + prof.email + "\n\nOffice Hours: \n";

                if(prof.hours.size() == 0) {
                    msg = msg + "No Office Hours this semester.";
                } else {
                    for (int m = 0; m < prof.hours.size(); m++) {
                        msg = msg + prof.hours.get(m) + "\n";
                    }
                }

                SpannableString s = new SpannableString(msg);
                Linkify.addLinks(s, Linkify.EMAIL_ADDRESSES);

                AlertDialog d = new AlertDialog.Builder(MainActivity.this).setTitle(title).setCancelable(true).setPositiveButton(android.R.string.ok, new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int which) {
                    }
                }).setMessage(s).show();
                ((TextView) d.findViewById(android.R.id.message)).

                        setMovementMethod(LinkMovementMethod.getInstance());

            }
        });
        setupSearchView();
    }


    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.action_refresh:
                d = new Downloader(this, url1, lv);
                d.execute();
                DownloadHours downloadHours = new DownloadHours(this, url2);
                downloadHours.execute();
                break;
            case R.id.about:
                Intent aboutIntent = new Intent(this, AboutActivity.class);
                startActivity(aboutIntent);

        }
        return super.onOptionsItemSelected(item);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return super.onCreateOptionsMenu(menu);
    }

    @Override
    protected void onStop() {

        SharedPreferences appSharedPrefs = PreferenceManager
                .getDefaultSharedPreferences(this.getApplicationContext());
        SharedPreferences.Editor prefsEditor = appSharedPrefs.edit();
        Gson gson = new Gson();
        String json = gson.toJson(p);
        prefsEditor.putString("Professors", json);
        prefsEditor.commit();
        super.onStop();
    }

    protected void onDestroy() {
        SharedPreferences appSharedPrefs = PreferenceManager
                .getDefaultSharedPreferences(this.getApplicationContext());
        SharedPreferences.Editor prefsEditor = appSharedPrefs.edit();
        Gson gson = new Gson();
        String json = gson.toJson(p);
        prefsEditor.putString("Professors", json);
        prefsEditor.commit();
        super.onDestroy();
    }

    @Override
    protected void onSaveInstanceState(Bundle outState) {
        pclone = (ArrayList<Professor>) p.clone();
        outState.putParcelableArrayList("key", pclone);
        super.onSaveInstanceState(outState);
    }

    // Makes adjustments to the search view to optimize it for the app
    private void setupSearchView() {
        searchView.setIconifiedByDefault(false);
        searchView.setOnQueryTextListener(this);
        searchView.setSubmitButtonEnabled(true);
        searchView.setQueryHint("Search Here");
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
            searchView.setFocusedByDefault(false);
        }
    }

    @Override
    public boolean onQueryTextChange(String newText) {
        if (TextUtils.isEmpty(newText)) {
            adapter.getFilter().filter("");
            Parcelable state = lv.onSaveInstanceState();
        } else {
            adapter.getFilter().filter(newText);
        }
        return true;
    }

    public boolean onQueryTextSubmit(String query) {
        return false;
    }


    /**
     * This class is used to download the Office Hours corresponding to each professor,
     * handle any intricacies that come with that, and then store them with each professor
     * object.
     */
    public static class DownloadHours extends AsyncTask<Void, Integer, String> {

        Context c;
        String address;
        public static DateTime currentDay = new DateTime();
        ProgressDialog pd;

        public DownloadHours(Context c, String address) {
            this.c = c;
            this.address = address;
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
            String sem;
            if(currentDay.getMonthOfYear() > 6) {
                sem = "FA-" + currentDay.getYearOfCentury();
            } else {
                sem = "SP-" + currentDay.getYearOfCentury();
            }
            pd.dismiss();

            if (s != null) {
                try {
                    JSONArray ja = new JSONArray(s);
                    JSONObject jo = null;

                    for (int i = 0; i < ja.length(); i++) {
                        jo = ja.getJSONObject(i);

                        String dayOfWeek = jo.getString("dayOfWeek");
                        String hourStart = jo.getString("OfficeHourStart");
                        String hourEnd = jo.getString("OfficeHourEnd");
                        String profID = jo.getString("Prof_ID");
                        String semester = jo.getString("Semester");

                        String addMeToProf = new String(dayOfWeek + " " + hourStart + " to " + hourEnd + " " + semester);
                        for (int j = 0; j < p.size(); j++) {
                            if (p.get(j).id == Integer.parseInt(profID) && !p.get(j).hours.contains(addMeToProf.substring(0, addMeToProf.length()-6)) && semester.equals(sem)) {
                                p.get(j).hours.add(addMeToProf.substring(0, addMeToProf.length()-6));
                                break;
                            }

                        }

                    }
                    Collections.sort(p, new Comparator<Professor>() {
                        @Override
                        public int compare(MainActivity.Professor p0, MainActivity.Professor p1) {
                            return (p0.getlName().compareTo(p1.getlName()));
                        }
                    });

                    adapter = new ProfessorAdapter(c, MainActivity.p);
                    lv.setAdapter(MainActivity.adapter);
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            } else {
                Toast.makeText(c, "Unable to download data", Toast.LENGTH_SHORT).show();
            }
        }

        // This is what is called in doInBackground
        private String downloadData() throws IOException {
            // Connect and get a stream of data
            InputStream is = null;
            String line = null;

            try {
                URL url = new URL(address);
                HttpURLConnection con = (HttpURLConnection) url.openConnection();
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

        // This method colors the background of a list view item green if the Professor's Office
        // Hours are open at the time the OS has.
        @RequiresApi(api = Build.VERSION_CODES.O)
        public static void colorListView(Professor color, View view) {
            color.inOffice = false;
            Integer bHour;
            Integer eHour;
            Integer eMin;
            Integer bMin;
            SimpleDateFormat sdf = new SimpleDateFormat("EEE");
            Date d = new Date();
            String dayOfTheWeek = sdf.format(d);
            DateTime dt = new DateTime();
            int currHour = dt.getHourOfDay();
            int currMin = dt.getMinuteOfHour();
            for (int i = 0; i < color.hours.size(); i++) {
                String[] entry = color.hours.get(i).toUpperCase().split("\\s+");
                String[] begin = entry[1].split(":");
                String[] end = entry[3].split(":");
                bHour = Integer.parseInt(begin[0]);
                bMin = Integer.parseInt(begin[1]);
                eHour = Integer.parseInt(end[0]);
                eMin = Integer.parseInt(end[1]);
                if (bHour < 8) {
                    bHour += 12;
                }
                if (eHour < 8) {
                    eHour += 12;
                }
                switch (dayOfTheWeek.substring(0, 2)) {
                    case "Mo":
                        if (entry[0].contains("M")) {
                            if (bHour <= currHour && eHour >= currHour) { // If the hour is between the hours listed
                                if (eHour == currHour && eMin < currMin) { // If the hours are equal, minutes are less than current min
                                    break;
                                } else if (bHour == currHour && currMin < bMin) {
                                    break;
                                } else {
                                    color.inOffice = true;
                                }
                            }
                        }
                        break;
                    case "Tu":
                        if (entry[0].contains("T")) {
                            if (bHour <= currHour && eHour >= currHour) { // If the hour is between the hours listed
                                if (eHour == currHour && eMin < currMin) { // If the hours are equal, minutes are less than current min
                                    break;
                                } else if (bHour == currHour && currMin < bMin) {
                                    break;
                                } else {
                                    color.inOffice = true;
                                }
                            }
                        }
                        break;
                    case "We":
                        if (entry[0].contains("W")) {
                            if (bHour <= currHour && eHour >= currHour) { // If the hour is between the hours listed
                                if (eHour == currHour && eMin < currMin) { // If the hours are equal, minutes are less than current min
                                    break;
                                } else if (bHour == currHour && currMin < bMin) {
                                    break;
                                } else {
                                    color.inOffice = true;
                                }
                            }
                        }
                        break;
                    case "Th":
                        if (entry[0].contains("R")) {
                            if (bHour <= currHour && eHour >= currHour) { // If the hour is between the hours listed
                                if (eHour == currHour && eMin < currMin) { // If the hours are equal, minutes are less than current min
                                    break;
                                } else if (bHour == currHour && currMin < bMin) {
                                    break;
                                } else {
                                    color.inOffice = true;
                                }
                            }
                        }
                        break;
                    case "Fr":
                        if (entry[0].contains("F")) {
                            if (bHour <= currHour && eHour >= currHour) { // If the hour is between the hours listed
                                if (eHour == currHour && eMin < currMin) { // If the hours are equal, minutes are less than current min
                                    break;
                                } else if (bHour == currHour && currMin < bMin) {
                                    break;
                                } else {
                                    color.inOffice = true;
                                }
                            }
                        }
                        break;
                }

            }
        }
    }

    /**
     * This class creates a Constructor object for a Professor that holds each professors
     * information.
     *
     * Due to the nature of this class's constructor object, Parcels are used for long-term storage.
     */
    public static class Professor implements Parcelable {

        private int id;
        public String prefix;
        private String fName;
        private String lName;
        public String offBuilding;
        public String offNumber;
        public String email;
        public ArrayList<String> hours = new ArrayList<>();
        public boolean favorited;
        public boolean inOffice = false;

        public Professor(int id, String prefix, String fName, String lName, String offBuilding, String offNumber, String email) {

            this.id = id;
            this.prefix = prefix;
            this.fName = StringUtils.capitalize(fName);
            this.lName = StringUtils.capitalize(lName);
            this.offBuilding = offBuilding;
            this.offNumber = offNumber;
            this.email = email;
            this.favorited = false;
        }

        protected Professor(Parcel in) {
            id = in.readInt();
            prefix = in.readString();
            fName = in.readString();
            lName = in.readString();
            offBuilding = in.readString();
            offNumber = in.readString();
            email = in.readString();
            hours = in.createStringArrayList();
            favorited = in.readByte() != 0;
        }

        // This method helps read from parcels to recreate the professor objects when save states
        // are used.
        public static final Creator<Professor> CREATOR = new Creator<Professor>() {
            @Override
            public Professor createFromParcel(Parcel in) {
                return new Professor(in);
            }

            @Override
            public Professor[] newArray(int size) {
                return new Professor[size];
            }
        };

        public String getlName() {
            return this.lName;
        }

        public String getFullName() {
            return this.fName + " " + this.lName;
        }

        @Override
        public int describeContents() {
            return 0;
        }


        @Override
        public void writeToParcel(Parcel parcel, int i) {
            parcel.writeInt(id);
            parcel.writeString(fName);
            parcel.writeString(lName);
            parcel.writeString(offBuilding);
            parcel.writeString(offNumber);
            parcel.writeString(email);
            parcel.writeByte((byte) (favorited ? 1 : 0));
        }

        public static boolean containsProf(ArrayList<Professor> list, Professor prof) {
            for (int i = 0; i < list.size(); i++) {
                if (prof.id == list.get(i).id) {
                    return true;
                }
            }
            return false;
        }
    }

}