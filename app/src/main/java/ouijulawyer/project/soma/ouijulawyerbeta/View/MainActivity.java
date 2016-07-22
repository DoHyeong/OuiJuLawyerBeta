package ouijulawyer.project.soma.ouijulawyerbeta.View;

import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.util.Log;
import android.view.View;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.AdapterView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.List;

import ouijulawyer.project.soma.ouijulawyerbeta.Controller.ContractGallery;
import ouijulawyer.project.soma.ouijulawyerbeta.R;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.ContractGalleryAdapter;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.GetMyContractRepo;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.GetMyContractService;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.OuijuGlobal;
import retrofit.Callback;
import retrofit.RestAdapter;
import retrofit.RetrofitError;
import retrofit.client.Response;

public class MainActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {

    private CharSequence mTitle;
    private LinearLayout contract_area;
    List<String> csid = new ArrayList<String>();


    private ContractGallery contractGallery;

    private TextView loadingInfo;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
                        .setAction("Action", null).show();
            }
        });

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.setDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);
        //////
        contractGallery = (ContractGallery)findViewById(R.id.gallery);
        loadingInfo = (TextView)findViewById(R.id.loading_info_text);


        TextView text1 = (TextView)findViewById(R.id.textView4);
        String aa =  OuijuGlobal.name;
        text1.setText("외주왕 "+aa+"님 안녕하세요");

        getMyContractJson();

    }

    void getMyContractJson(){
        try{
            // NaverInfoService service = retrofit.create(NaverInfoService.class);
            RestAdapter retrofit = new RestAdapter.Builder()
                    .setEndpoint("http://ouijulawyer.azurewebsites.net")
                    .build();

            GetMyContractService service = retrofit.create(GetMyContractService.class);

            Log.d("aaaa",OuijuGlobal.session);

            service.listRepos("GetMyContract", OuijuGlobal.session, new Callback<List<GetMyContractRepo>>() {


                @Override
                public void success(final List<GetMyContractRepo> getMyContractRepos, Response response) {
                    loadingInfo.setText("");
                    GetMyContractRepo test = getMyContractRepos.get(0);

                    contractGallery.setAdapter(new ContractGalleryAdapter(getApplicationContext(),getMyContractRepos));

                    List<GetMyContractRepo> temp = getMyContractRepos;
                    int count = temp.size();

                    for(int i= 0; i<count; i++){
                        csid.add(temp.get(i).csid);
                        //  imageList.add(repo.get(i).file);

                    }

                    contractGallery.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                        @Override
                        public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                            Toast.makeText(MainActivity.this,csid.get(position),Toast.LENGTH_SHORT).show();
                            //Intent intent = new Intent(MainActivity.this,ContractDetailActivity.class);
                           // intent.putExtra("csid",csid.get(position));
                           // startActivity(intent);

                        }
                    });


                    Log.d("test1111",test.toString());
                }

                @Override
                public void failure(RetrofitError error) {

                    Log.d("test",error.toString());

                }
            });


        }catch (Exception e){
            Log.d("aaaa3",e.toString());

        }
    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        if (id == R.id.nav_camera) {
            // Handle the camera action
        } else if (id == R.id.nav_gallery) {

        } else if (id == R.id.nav_slideshow) {

        } else if (id == R.id.nav_share) {

        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
}
