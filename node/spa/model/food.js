var mysql = require("mysql");

module.exports =  {
    blank: function(){ return {} },
    get: function(id, ret){
        var conn = GetConnection();
        var sql = 'SELECT * Food ';
        if(id){
          sql += " WHERE Food_id = " + id;
        }
        conn.query(sql, function(err,rows){
          ret(err,rows);
          conn.end();
        });        
    },
    delete: function(id, ret){
        var conn = GetConnection();
        conn.query("DELETE FROM Food WHERE Food_id = " + id, function(err,rows){
          ret(err);
          conn.end();
        });        
    },
    save: function(row, ret){
        var sql;
        var conn = GetConnection();
        //  TODO Sanitize
        if (row.id) {
				  sql = " Update Food "
							+ " Set Name=?, Time=?, Calories=? "
						  + " WHERE Food_id = ? ";
			  }else{
				  sql = "INSERT INTO Person "
						  + " (Name, Time, Created_at, Calories) "
						  + "VALUES (?, ?, Now() ), ? ";				
			  }

        conn.query(sql, [row.Name, row.Time, row.Calories, row.id],function(err,data){
          if(!err && !row.id){
            row.id = data.insertId;
          }
          ret(err, row);
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
    
          database: "c9"
        });
    return conn;
}
