/**
 * Created by Matt Lupino
 *
 * This class handles the data that was downloaded from the database and create Professor Objects
 * with it.
 */
package com.example.matteo81992.office_hours_real;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.os.Build;
import android.support.design.widget.Snackbar;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Filter;
import android.widget.ListView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;

import static com.example.matteo81992.office_hours_real.MainActivity.Professor.containsProf;



public class Parser extends AsyncTask<Void, Integer, Integer> {

    Context c;
    ListView lv;
    String data;

    public static ArrayList<MainActivity.Professor> professors = new ArrayList<>();
    ProgressDialog pd;

    public Parser(Context c, ListView lv, String data) {
        this.c = c;
        this.lv = lv;
        this.data = data;
    }

    @Override
    protected void onPreExecute() {
        super.onPreExecute();
        pd = new ProgressDialog(c);
        pd.setTitle("Parser");
        pd.setMessage("Parsing... Please wait.");
        pd.show();
    }

    @Override
    protected Integer doInBackground(Void... voids) {

        return this.parse();
    }

    @Override
    protected void onPostExecute(Integer integer) {
        super.onPostExecute(integer);

        if (integer == 1) {

        } else {
            Toast.makeText(c, "Unable to parse data", Toast.LENGTH_SHORT).show();
        }

        pd.dismiss();

    }

    // This is called in doInBackground
    private int parse() {
        try {
            JSONArray ja = new JSONArray(data);
            JSONObject jo = null;

            professors.clear();

            for (int i = 0; i < ja.length(); i++) {
                jo = ja.getJSONObject(i);

                String fname = jo.getString("FirstName");
                String lname = jo.getString("LastName");
                String officeLoc = jo.getString("OfficeBuilding");
                String email = jo.getString("email");
                String officeNum = jo.getString("OfficeNumber");
                String prefix = jo.getString("Prefix");
                int id = jo.getInt("Prof_ID");
                MainActivity.Professor addMe = new MainActivity.Professor(id, prefix, fname, lname, officeLoc, officeNum, email);
                professors.add(addMe);
                if (!containsProf(MainActivity.p, addMe)) {
                    MainActivity.p.add(addMe);
                }
            }
            syncWithDB(professors, MainActivity.p);
            return 1;
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return 0;
    }

    // This is what we use to make sure the data downloaded overrides the data already stored in
    // permanent storage.
    private void syncWithDB(ArrayList<MainActivity.Professor> upToDate, ArrayList<MainActivity.Professor> needsUpdate) {
        int size = needsUpdate.size();
        String sem;
        if(MainActivity.DownloadHours.currentDay.getMonthOfYear() > 6) {
            sem = "FA-" + MainActivity.DownloadHours.currentDay.getYearOfCentury();
        } else {
            sem = "SP-" + MainActivity.DownloadHours.currentDay.getYearOfCentury();
        }
        for (int i = 0; i < size; i++) {
            if (!containsProf(upToDate, needsUpdate.get(i))) {
                needsUpdate.remove(i);
                i--;
                size--;
            }
        }
        for(int i = 0; i < needsUpdate.size(); i++) {
            for(int j = 0; j < needsUpdate.get(i).hours.size(); j++) {
                if(!needsUpdate.get(i).hours.get(j).substring(needsUpdate.get(i).hours.get(j).length()-5).toUpperCase().equals(sem)) {
                    needsUpdate.get(i).hours.remove(j);
                    j--;
                }
            }
        }
    }


}
