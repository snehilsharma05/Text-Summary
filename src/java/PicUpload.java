import java.io.*;
import java.sql.Connection;
import java.sql.PreparedStatement;
import javax.servlet.ServletException;
import javax.servlet.annotation.MultipartConfig;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import javax.servlet.http.Part;
 
//@javax.servlet.annotation.MultipartConfig
@MultipartConfig
public class PicUpload extends HttpServlet {
   
public void service(HttpServletRequest request, HttpServletResponse response)
      throws ServletException, java.io.IOException {
     
    String uid=request.getParameter("uid");
    try{
    Part part= request.getPart("file");
    InputStream is= part.getInputStream();
    
    Connection con= fac.Factory.getCon();
    PreparedStatement ps=  con.prepareStatement("update users set pic=? where id=?");
    ps.setBlob(1, is);
    ps.setString(2, uid);
    ps.executeUpdate();
    ps.close();
    con.close();
    
    response.sendRedirect("userHome.jsp");
    
    
    
    }
    catch(Exception e)
    {}
    
    
      }
   
   
   public void doPost(HttpServletRequest request, HttpServletResponse response)
      throws ServletException, java.io.IOException {
       service(request, response);
       
      }
      
      public void doGet(HttpServletRequest request, HttpServletResponse response)
         throws ServletException, java.io.IOException {

          service(request, response);
      }
   }
