package com.olympicmedals;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import org.json.JSONObject;

@WebServlet("/addMedal")
public class AddMedalServlet extends HttpServlet {
    @Override
    protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        resp.setContentType("application/json");
        resp.setCharacterEncoding("UTF-8");

        try (PrintWriter out = resp.getWriter()) {
            StringBuilder sb = new StringBuilder();
            String line;
            while ((line = req.getReader().readLine()) != null) {
                sb.append(line);
            }

            JSONObject json = new JSONObject(sb.toString());
            String country = json.getString("country");
            int gold = json.getInt("gold");
            int silver = json.getInt("silver");
            int bronze = json.getInt("bronze");

            try (Connection conn = DatabaseManager.getConnection();
                 PreparedStatement stmt = conn.prepareStatement("INSERT INTO medals (country, gold, silver, bronze) VALUES (?, ?, ?, ?)")) {
                stmt.setString(1, country);
                stmt.setInt(2, gold);
                stmt.setInt(3, silver);
                stmt.setInt(4, bronze);
                stmt.executeUpdate();
            } catch (SQLException e) {
                e.printStackTrace();
                resp.setStatus(HttpServletResponse.SC_INTERNAL_SERVER_ERROR);
                out.write("{\"status\":\"error\"}");
                return;
            }

            out.write("{\"status\":\"success\"}");
        }
    }
}
