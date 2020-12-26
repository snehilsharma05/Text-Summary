

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.Driver;
import java.sql.DriverManager;
import java.sql.Statement;
import javax.mail.Session;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;


public class Uploadd extends HttpServlet {


    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        PrintWriter out = response.getWriter();
        response.setContentType("text/html;charset=UTF-8");
        String main=request.getParameter("mtext");
        HttpSession session=request.getSession();
        String filename= request.getParameter("filename");
        String id=(String) session.getAttribute("id");
        int id1=Integer.parseInt(id);
        String des=request.getParameter("des");
        String sub=request.getParameter("stext");
        Connection con=null;
        Statement stmt=null;
        try  {
         Driver d1=new com.mysql.jdbc.Driver();
	DriverManager.registerDriver(d1);

		con=DriverManager.getConnection("jdbc:mysql://localhost:3306/project","root","root");
                                stmt=con.createStatement();
					
                            int nore=stmt.executeUpdate("insert into uploaddata(userid,main_category,sub_category,filename,description) values('"+id1+"','"+main+"','"+sub+"','"+filename+"','"+des+"')");
                         if(nore>0)
                         {
                              
                                 request.setAttribute("status", "Data Entered");
                                
                                
                                 RequestDispatcher rd=request.getRequestDispatcher("DataEntered.jsp");
                                 rd.forward(request, response);
                         }
        }
        catch(Exception e)
        {
            System.err.println(e);
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
