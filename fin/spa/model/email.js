var mysql = require("mysql");

module.exports =  {
    blank: function(){ return {} },
    get: function(id, ret){
        var conn = GetConnection();
        var sql = 'SELECT * FROM Emails ';
        if(id){
          sql += " WHERE id = " + id;
        }
        conn.query(sql, function(err,rows){
          ret(err,rows);
          conn.end();
        });        
    },
    delete: function(id, ret){
        var conn = GetConnection();
        conn.query("DELETE FROM Emails WHERE id = " + id, function(err,rows){
          ret(err);
          conn.end();
        });        
    },
    save: function(row, ret){
        var sql;
        var conn = GetConnection();
        //  TODO Sanitize
        if (row.id) {
				  sql = " Update Emails "
							+ " Set Name=?, Person_id=? "
						  + " WHERE id = ? ";
			  }else{
				  sql = "INSERT INTO Emails "
						  + " (Name, Created_at, Person_id) "
						  + "VALUES (?, Now(), 1) ";				
			  }

        conn.query(sql, [row.Name, row.Person_id, row.id],function(err,data){
          if(!err && !row.id){
            row.id = data.insertId;
          }
         // ret(err, row);
          conn.end();
        });        
    },
    validate: function(row){
      var errors = {};
      
      if(!row.Name) errors.Name = "is required"; 
     
      
      return errors.length ? errors : false;
    }
};  

function GetConnection(){
        var conn = mysql.createConnection({
          host: "localhost",
          user: "jx49",
          password: "6666",
          database: "c9"
        });
    return conn;
}
