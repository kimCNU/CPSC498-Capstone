/**
 * Created by Matt Lupino
 *
 * This class is used to display the About activity, which is just a text view displaying some
 * info about this app. It also attributes the icon we used for the app to its creators.
 *
 */
package com.example.matteo81992.office_hours_real;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;


public class AboutActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_about);
    }
}
