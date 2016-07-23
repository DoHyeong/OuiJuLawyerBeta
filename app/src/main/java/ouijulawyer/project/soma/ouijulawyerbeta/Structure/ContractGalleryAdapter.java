package ouijulawyer.project.soma.ouijulawyerbeta.Structure;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.Toast;

import com.squareup.picasso.Picasso;

import java.util.ArrayList;
import java.util.List;

import ouijulawyer.project.soma.ouijulawyerbeta.R;


/**
 * Created by Kim on 2016-07-18.
 */
public class ContractGalleryAdapter extends BaseAdapter {
    private Context mContext;
    private ImageView image;
    private Button button;
    private LayoutInflater mInflater;
    private int count;

    private  int[] mImageID;
    private List<String> imageList = new ArrayList<String>();


         public ContractGalleryAdapter(Context c, List<GetMyContractRepo> repo) {
            mContext = c;
            mInflater = (LayoutInflater) mContext.getSystemService(Context.LAYOUT_INFLATER_SERVICE);

            count = repo.size();

            for(int i= 0; i<count; i++){

                imageList.add(repo.get(i).file);

            }

        }

        public int getCount() {
            return count;
        }

        public Object getItem(int position) {
                return position;
           }

        public long getItemId(int position) {
            return position;
           }


        public View getView(final int position, View convertView, ViewGroup parent) {
               View mview = convertView;

              if (mview == null) {

                  mview = mInflater.inflate(R.layout.contract_gallery, null);
              }

             image = (ImageView) mview.findViewById(R.id.image);

             String url = imageList.get(position);
             Picasso.with(mContext).load("http://ouijulawyer.azurewebsites.net/contract/"+url+".png").into(image);

             return mview;

           }

    }
