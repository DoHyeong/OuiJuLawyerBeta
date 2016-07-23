package ouijulawyer.project.soma.ouijulawyerbeta.Model;

import android.util.Log;

import com.google.gson.Gson;

import retrofit.RestAdapter;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.NaverInfoRepo;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.NaverInfoService;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.NaverLoginRepo;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.NaverLoginService;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.OuijuGlobal;
/**
 * Created by KIM on 2016. 7. 23..
 */
public class NaverClass {

        String token;
        String type;

        ////////////

        String name;
        String id;
        String birthday;
        String resultcode;
        String message;

        RestAdapter retrofit;


public NaverClass(String type,String token){

        this.token = token;
        this.type = type;
        initGetInfo();



        }

        void initGetInfo(){
        retrofit = new RestAdapter.Builder()
        .setEndpoint("http://ouijulawyer.azurewebsites.net")
        .build();


        NaverInfoService service = retrofit.create(NaverInfoService.class);

        NaverInfoRepo naverInfoRepo = service.listRepos("GetNaverUserInfo",this.type,this.token);
        Log.d("a369", new Gson().toJson(naverInfoRepo));
        name = naverInfoRepo.name;
        id = naverInfoRepo.id;
        birthday = naverInfoRepo.birthday;
        resultcode = naverInfoRepo.resultcode;
        message = naverInfoRepo.message;

        OuijuGlobal.name = name;
        OuijuGlobal.session = id;
        OuijuGlobal.type  = "N";

        }

public String naverLogin(){
        NaverLoginService service = retrofit.create(NaverLoginService.class);

        NaverLoginRepo naverLoginRepo = service.listRepos("NaverLogin",this.id);

        if(naverLoginRepo.success == "0"){
        return "fail";
        }else{
        return naverLoginRepo.session;
        }




        }


public String getBirthday(){
        return birthday;
        }


public String getName(){

        return  name;

}
        }