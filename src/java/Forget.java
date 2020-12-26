
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import com.pjc.*;
import com.pjc.api.MailSender;
import java.sql.Connection;
import java.sql.Driver;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.LinkedList;
import java.util.List;

import javax.servlet.RequestDispatcher;
import javax.servlet.http.HttpSession;

public class Forget extends HttpServlet {

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
         Connection con=null;
	Statement stmt=null;
	 PrintWriter out=response.getWriter();
         
        String email=request.getParameter("email");
        String emaildb="";
         String passdb="";
         List l=new LinkedList();
         if(email.length()==0)
{
    l.add("1");
}

        if(!l.isEmpty())
{
request.setAttribute("error2",l);
RequestDispatcher rd=request.getRequestDispatcher("forgot.jsp");
rd.forward(request,response);
}
if(l.isEmpty())
{
      
      
try
{
       int flag=0;
	Driver d1=new com.mysql.jdbc.Driver();
	DriverManager.registerDriver(d1);
		
		con=DriverManager.getConnection("jdbc:mysql://localhost:3306/project","root","root");
                                stmt=con.createStatement();
								
                            ResultSet rs=stmt.executeQuery(" select password from users where email='"+email+"'");
                           
                             while(rs.next())
                             {
                                  flag++;
                                  passdb=rs.getString("password");
                             }
                         
                                if(flag>0)
                                {
                        MailSender ms=new MailSender();
                                 ms.sendMail(email,"Forget Password" , "your password is "+passdb);
                               response.sendRedirect("MailSent.jsp");
                                }
                                else
                                {
                           
                             //HttpSession session=request.getSession();
                             //session.setAttribute("msg", msg);
                               response.sendRedirect("Mailnotsent.jsp");
                            
                                }				   
}
	catch(Exception e)
	{
		out.println(e);
	}

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
