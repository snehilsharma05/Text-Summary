import java.io.*;
import java.sql.Connection;
import java.sql.Driver;
import java.sql.DriverManager;
import java.sql.Statement;
import java.sql.Timestamp;
import java.util.*;
import javax.servlet.RequestDispatcher;
 
import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
 
import org.apache.commons.fileupload.FileItem;
import org.apache.commons.fileupload.FileUploadException;
import org.apache.commons.fileupload.disk.DiskFileItemFactory;
import org.apache.commons.fileupload.servlet.ServletFileUpload;
import org.apache.commons.io.output.*;
//@javax.servlet.annotation.MultipartConfig
public class UploadServlet extends HttpServlet {
   
   private boolean isMultipart;
   private String filePath;
   private int maxFileSize = 50 * 1024*1024;
   private int maxMemSize = 4 * 1024*1024;
   private File file ;

   public void init( ){
      
      filePath = getServletContext().getInitParameter("file-upload"); 
   }
   
   public void doPost(HttpServletRequest request, HttpServletResponse response)
      throws ServletException, java.io.IOException {
   
      // Check that we have a file upload request
      isMultipart = ServletFileUpload.isMultipartContent(request);
      response.setContentType("text/html");
      java.io.PrintWriter out = response.getWriter( );
       HttpSession session=request.getSession();
      String id=(String)session.getAttribute("id");
       int id1=Integer.parseInt(id);
       String main=request.getParameter("mtext");
String sub=request.getParameter("stext");
            
      if( !isMultipart ) {
         out.println("<html>");
         out.println("<head>");
         
         out.println("<title>Servlet upload</title>");  
         out.println("</head>");
         out.println("<body>");
         out.println("<p>No file uploaded</p>"); 
         out.println("</body>");
         out.println("</html>");
         return;
      }
  
      DiskFileItemFactory factory = new DiskFileItemFactory();
   

      factory.setSizeThreshold(maxMemSize);
   

      factory.setRepository(new File("c:\\temp"));


      ServletFileUpload upload = new ServletFileUpload(factory);
   

      upload.setSizeMax( maxFileSize );
      Connection con=null;
	Statement stmt=null;
        
String fileName=null;


      try { 
    
          List fileItems = upload.parseRequest(request);
	
         // Process the uploaded file items
         Iterator i = fileItems.iterator();

         out.println("<html>");
         out.println("<head>");
         out.println("<title>Servlet upload</title>");  
         out.println("</head>");
         out.println("<body>");
   
         while ( i.hasNext () ) {
            FileItem fi = (FileItem)i.next();
            if ( !fi.isFormField () ) {
               // Get the uploaded file parameters
               String fieldName = fi.getFieldName();
                fileName = fi.getName();
                //out.println(fileName);
                 
                
                  String contentType = fi.getContentType();
               boolean isInMemory = fi.isInMemory();
               long sizeInBytes = fi.getSize();
            
               // Write the file
               if( fileName.lastIndexOf("\\") >= 0 ) {
                  file = new File( filePath + fileName.substring( fileName.lastIndexOf("\\"))) ;
               } else {
                   System.err.println("Full Path: "+fileName);                  
                    String ar[]= fileName.split("\\.");
                
                   
                  fileName= System.currentTimeMillis()+"."+ar[1];
                  System.err.println("Full Path: "+filePath + fileName);                  
                   
                  file = new File( filePath + fileName) ;
               }
               fi.write( file ) ;
               out.println("Uploaded Filename: " + fileName + "<br>");
            }
         }
          request.setAttribute("filename", fileName);
          RequestDispatcher rd=request.getRequestDispatcher("FileDescriber.jsp");
          rd.forward(request, response);
          out.println("</body>");
         out.println("</html>");
         } catch(Exception ex) {
            System.out.println(ex);
         }
       
      }
      
      public void doGet(HttpServletRequest request, HttpServletResponse response)
         throws ServletException, java.io.IOException {

         throw new ServletException("GET method used with " +
            getClass( ).getName( )+": POST method required.");
      }
   }
