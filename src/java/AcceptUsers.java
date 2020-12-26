
import com.pjc.api.*;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.*;
import java.sql.*;
import java.util.LinkedList;
import java.util.List;
import javax.servlet.RequestDispatcher;



public class AcceptUsers extends HttpServlet
{
public void processRequest(HttpServletRequest request,HttpServletResponse response)throws ServletException,IOException
{
    String uid= request.getParameter("id");
    String email=request.getParameter("email");
    
    
    
        Connection con=null;
	Statement stmt=null;
	 PrintWriter out=response.getWriter();
         
         
      
try
{
	Driver d1=new com.mysql.jdbc.Driver();
	DriverManager.registerDriver(d1);
		//Class.forName("com.mysql.jdbc.Driver");
		con=DriverManager.getConnection("jdbc:mysql://localhost:3306/project","root","root");
                                stmt=con.createStatement();
								
                            int nore= stmt.executeUpdate("Update users set status='1' where id='"+uid+"' ");
                             if(nore>0)
                             {
                                 
                                 request.setAttribute("status", "User Approved Successfully!");
                                 RequestDispatcher rd=request.getRequestDispatcher("pendingUsers.jsp");
                                 rd.forward(request, response);
                                 MailSender ms=new MailSender();
                                 ms.sendMail(email,"Test" , "Howwwwwwwwwwwwwwwwwwww");
                                 
                             }
                             else
                             {
                             
                                 request.setAttribute("status", "Can't Approved !");
                                 RequestDispatcher rd=request.getRequestDispatcher("pendingUsers.jsp");
                                 rd.forward(request, response);
                             
                             }
                             
								   
}
	catch(Exception e)
	{
		out.println(e);
	}

}



    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    @Override
    public String getServletInfo() {
        return "Short description";
    }

}
