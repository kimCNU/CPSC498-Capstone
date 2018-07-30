/**
 * Created by Matt Lupino
 *
 * This class is a custom adapter we used for our Professor objects when displaying them in our
 * List View. It allows for extra flexibility when displaying our list.
 *
 * It contains two classes: one for the adapter, and one for the custom filter as well.
 *
 */
package com.example.matteo81992.office_hours_real;

import android.content.Context;
import android.content.res.Resources;
import android.graphics.Color;
import android.os.Build;
import android.support.annotation.NonNull;
import android.support.annotation.RequiresApi;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.ArrayAdapter;
import android.widget.Filter;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.ArrayList;

/**
 * This is the class for the custom Adapter. Creates a list object with a heart image and the names
 * of the professors.
 */
public class ProfessorAdapter extends ArrayAdapter<MainActivity.Professor> {
    private ArrayList<MainActivity.Professor> cloned = (ArrayList<MainActivity.Professor>) MainActivity.p.clone();
    private Context mContext;
    private ArrayList<MainActivity.Professor> profList = new ArrayList<>();
    public Filter filter;
    Animation anim;

    public ProfessorAdapter(Context context, ArrayList<MainActivity.Professor> list) {
        super(context, 0, list);
        mContext = context;
        profList = list;
        anim = AnimationUtils.loadAnimation(this.mContext, R.anim.heart);
    }

    @RequiresApi(api = Build.VERSION_CODES.O)
    @NonNull
    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        View listItem = convertView;
        if (listItem == null)
            listItem = LayoutInflater.from(mContext).inflate(R.layout.list_element, parent, false);

        final MainActivity.Professor currentProf = profList.get(position);

        final ImageView image = (ImageView) listItem.findViewById(R.id.fave);

        if (currentProf.favorited) {
            image.setImageResource(R.drawable.favorite);
        } else {
            image.setImageResource(R.drawable.unfavorite);
        }

        image.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                if (currentProf.favorited) {
                    currentProf.favorited = false;
                    image.setImageResource(R.drawable.unfavorite);
                } else {
                    currentProf.favorited = true;
                    image.setImageResource(R.drawable.favorite);
                    image.startAnimation(anim);
                }
            }
        });

        TextView name = (TextView) listItem.findViewById(R.id.profName);
        name.setText(currentProf.getFullName());


        MainActivity.DownloadHours.colorListView(currentProf, listItem);
        if (currentProf.inOffice) {
            listItem.setBackgroundColor(Color.parseColor("#a6ffa3"));
        } else {
            listItem.setBackgroundColor(Color.WHITE);
        }
        return listItem;
    }

    public Filter getFilter() {
        if (filter == null)
            filter = new ProfessorFilter();
        return filter;
    }

    /**
     * Allows for sorting by professor's name, and allows us to sort by favorites using keywords.
     */
    public class ProfessorFilter extends Filter {

        @Override
        protected FilterResults performFiltering(CharSequence charSequence) {
            charSequence = charSequence.toString().toLowerCase();
            FilterResults result = new FilterResults();
            if (charSequence.toString().equals("fave") || charSequence.toString().equals("fav") || charSequence.toString().equals("favorite")) {
                ArrayList<MainActivity.Professor> filt = new ArrayList<MainActivity.Professor>();
                ArrayList<MainActivity.Professor> lItems = new ArrayList<MainActivity.Professor>();

                lItems.addAll(cloned);

                for (int i = 0, l = lItems.size(); i < l; i++) {
                    MainActivity.Professor professor = lItems.get(i);
                    if (professor.favorited)
                        filt.add(professor);
                }
                result.count = filt.size();
                result.values = filt;
            } else if (charSequence != null && charSequence.toString().length() > 0) {
                ArrayList<MainActivity.Professor> filt = new ArrayList<MainActivity.Professor>();
                ArrayList<MainActivity.Professor> lItems = new ArrayList<MainActivity.Professor>();

                lItems.addAll(MainActivity.p);

                for (int i = 0, l = lItems.size(); i < l; i++) {
                    MainActivity.Professor professor = lItems.get(i);
                    if (professor.getFullName().toLowerCase().contains(charSequence))
                        filt.add(professor);
                }
                result.count = filt.size();
                result.values = filt;
            } else {
                MainActivity.p = (ArrayList<MainActivity.Professor>) cloned.clone();

                result.values = MainActivity.p;
                result.count = MainActivity.p.size();
            }
            return result;
        }

        @Override
        protected void publishResults(CharSequence charSequence, FilterResults filterResults) {
            profList = (ArrayList<MainActivity.Professor>) filterResults.values;
            notifyDataSetChanged();
            clear();
            for (int i = 0; i < profList.size(); i++)
                add(profList.get(i));
            notifyDataSetInvalidated();


        }
    }
}