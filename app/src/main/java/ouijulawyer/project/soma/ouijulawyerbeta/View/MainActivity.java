package ouijulawyer.project.soma.ouijulawyerbeta.View;

import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.Color;
import android.graphics.drawable.Drawable;
import android.net.Uri;
import android.os.Bundle;
import android.os.Environment;
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
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.squareup.picasso.Picasso;
import com.squareup.picasso.Target;

import org.w3c.dom.Text;

import java.io.File;
import java.io.FileOutputStream;
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
    private TextView giyodo;

    private RelativeLayout re_comehere;

    private  LoadingDialog loading;




    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);



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
        giyodo = (TextView)findViewById(R.id.text_giyodo);
        re_comehere = (RelativeLayout)findViewById(R.id.relative_comehere);

        loading = new LoadingDialog(MainActivity.this, "로딩중", "Azure Japan West서버와 통신중입니다.");



        TextView text1 = (TextView)findViewById(R.id.textView4);
        String aa =  OuijuGlobal.name;
        text1.setText("외주왕 "+aa+"님 안녕하세요");

        //getMyContractJson();

        re_comehere.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mkComeHere();
            }
        });

        getMyContractJson();


    }


    void getMyContractJson(){

            // NaverInfoService service = retrofit.create(NaverInfoService.class);
            RestAdapter retrofit = new RestAdapter.Builder()
                    .setEndpoint("http://ouijulawyer.azurewebsites.net")
                    .build();

            GetMyContractService service = retrofit.create(GetMyContractService.class);

            Log.d("aaaa",OuijuGlobal.session);



                service.listRepos("GetMyContract", OuijuGlobal.session, new Callback<List<GetMyContractRepo>>() {


                    @Override
                    public void success(final List<GetMyContractRepo> getMyContractRepos, Response response) {
                        try {
                        loadingInfo.setText("");
                        GetMyContractRepo test = getMyContractRepos.get(0);

                        contractGallery.setAdapter(new ContractGalleryAdapter(getApplicationContext(), getMyContractRepos));

                        List<GetMyContractRepo> temp = getMyContractRepos;
                        int count = temp.size();
                        giyodo.setText(Integer.toString(count));
                        giyodo.setTextSize(35);
                        giyodo.setTextColor(Color.MAGENTA);
                        for (int i = 0; i < count; i++) {
                            csid.add(temp.get(i).csid);
                            //  imageList.add(repo.get(i).file);

                        }

                        contractGallery.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                            @Override
                            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                                Toast.makeText(MainActivity.this, csid.get(position), Toast.LENGTH_SHORT).show();
                                Intent intent = new Intent(MainActivity.this, ContractDetailActivity.class);
                                intent.putExtra("csid", csid.get(position));
                                startActivity(intent);

                            }
                        });


                        Log.d("test1111", test.toString());
                        }catch(Exception e){
                            Log.d("asdf","119");
                          //  getMyContractJson();
                        }
                    }

                    @Override
                    public void failure(RetrofitError error) {

                        Log.d("test", error.toString());

                    }
                });

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

//    @Override
//    public boolean onCreateOptionsMenu(Menu menu) {
//        // Inflate the menu; this adds items to the action bar if it is present.
//        getMenuInflater().inflate(R.menu.main, menu);
//        return true;
//    }
//
//    @Override
//    public boolean onOptionsItemSelected(MenuItem item) {
//        // Handle action bar item clicks here. The action bar will
//        // automatically handle clicks on the Home/Up button, so long
//        // as you specify a parent activity in AndroidManifest.xml.
//        int id = item.getItemId();
//git
//        //noinspection SimplifiableIfStatement
//        if (id == R.id.action_settings) {
//            return true;
//        }
//
//        return super.onOptionsItemSelected(item);
//    }
//
//    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        if (id == R.id.nav_camera) { //메인화면
            // Handle the camera action
        } else if (id == R.id.nav_gallery) { //내정보등록
            Intent intent = new Intent(MainActivity.this,MyInfoActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_slideshow) {//계약서작성
            Intent intent = new Intent(MainActivity.this,NewContractActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_share) {//친구초대

            mkComeHere();

        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

    void mkComeHere(){
        loading.show();
        Picasso.with(MainActivity.this).load("http://ouijulawyer.azurewebsites.net/comehere.png").into(new Target() {
            @Override
            public void onBitmapLoaded(Bitmap bitmap, Picasso.LoadedFrom from) {
                File dir =
                        Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_DCIM);
                // 폴더가 있는지 확인 후 없으면 새로 만들어준다.
                if(!dir.exists())
                    dir.mkdirs();

                FileOutputStream fos;
                try {
                    
                    long now = System.currentTimeMillis();
                    Bitmap contractimg = bitmap;
                    fos = new FileOutputStream(new File(dir, "/comehere.png"));
                    contractimg.compress(Bitmap.CompressFormat.PNG, 100, fos);
                    fos.close();
                    String current = dir + "/comehere.png";

                    File path = new File(current);
                    Uri uri = Uri.fromFile(path);

                    Intent intent = new Intent(Intent.ACTION_SEND); //전송 메소드를 호출합니다. Intent.ACTION_SEND
                    intent.setType("image/*"); //jpg 이미지를 공유 하기 위해 Type을 정의합니다.
                    intent.putExtra(Intent.EXTRA_STREAM, uri); //사진의 Uri를 가지고 옵니다.
                    loading.dismiss();
                    startActivity(Intent.createChooser(intent, "선택해주세요")); //Activity를 이용하여 호출 합니다.

                    deleteFile(current);

                }catch (Exception e){

                }


            }

            @Override
            public void onBitmapFailed(Drawable errorDrawable) {

            }

            @Override
            public void onPrepareLoad(Drawable placeHolderDrawable) {

            }

        });

    }
}
