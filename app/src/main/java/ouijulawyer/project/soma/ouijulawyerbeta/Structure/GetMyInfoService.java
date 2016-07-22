package ouijulawyer.project.soma.ouijulawyerbeta.Structure;

import java.util.List;

import retrofit.Callback;
import retrofit.http.GET;
import retrofit.http.Path;
import retrofit.http.Query;

/**
 * Created by KIM on 2016. 7. 22..
 */
public interface GetMyInfoService {
    @GET("/api/{api_name}.php")
    void listRepos(@Path("api_name") String api_name, @Query("session") String session, Callback<GetMyInfoRepo> value);
}
