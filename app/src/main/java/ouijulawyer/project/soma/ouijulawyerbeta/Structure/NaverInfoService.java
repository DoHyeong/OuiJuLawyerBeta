package ouijulawyer.project.soma.ouijulawyerbeta.Structure;

import retrofit.http.GET;
import retrofit.http.Path;
import retrofit.http.Query;

/**
 * Created by Kim on 2016-07-14.
 */
public interface NaverInfoService {
    @GET("/api/{api_name}.php")
  // void listRepos(@Path("api_name") String auth, @Query("type") String type, @Query("token") String token, Callback<NaverInfoRepo>value);
    NaverInfoRepo listRepos(@Path("api_name") String auth, @Query("type") String type, @Query("token") String token);
}
