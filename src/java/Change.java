

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.Driver;
import java.sql.DriverManager;
import java.sql.Statement;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;


public class Change extends HttpServlet {


    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        PrintWriter out = response.getWriter();
        response.setContentType("text/html;charset=UTF-8");
        String old=request.getParameter("old");
        String newpass=request.getParameter("new1");
        String confirm=request.getParameter("confirm");
        
        
        HttpSession session=request.getSession();
         String id=(String) session.getAttribute("id");
        int id1=Integer.parseInt(id);
        
        Connection con=null;
        Statement stmt=null;
        try  {
         Driver d1=new com.mysql.jdbc.Driver();
	DriverManager.registerDriver(d1);

		con=DriverManager.getConnection("jdbc:mysql://localhost:3306/project","root","root");
                                stmt=con.createStatement();
					
                            int nore=stmt.executeUpdate("update users set password='"+newpass+"' where id='"+id1+"'");
                         if(nore>0)
                         {
                           request.setAttribute("status", "Data Entered");
                           RequestDispatcher rd=request.getRequestDispatcher("passchange.jsp");
                                 rd.forward(request,response);
                         }
                         else
                         {
                             response.sendRedirect("changepass.jsp");
                         }
        }
        catch(Exception e)
        {
            System.err.println(e);
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
