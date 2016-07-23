package ouijulawyer.project.soma.ouijulawyerbeta.Structure;

import java.util.List;

import retrofit.Callback;
import retrofit.http.GET;
import retrofit.http.Path;
import retrofit.http.Query;

/**
 * Created by Kim on 2016-07-17.
 */
public interface EditMyInfoService {
    @GET("/api/{api_name}.php")
    void listRepos(@Path("api_name") String api_name, @Query("session") String session, @Query("name") String name, @Query("phone") String phone, @Query("birth") String birth, @Query("bank") String bank, @Query("account") String accout, Callback<EditMyInfoRepo>value);

}
