var mysql = require("mysql");
var userId = require("../inc/userid");

module.exports =  {
    blank: function(){ return {} },
    get: function(id, ret, searchType){
        var conn = GetConnection();
        var sql = 'SELECT * FROM Person';
        if(id){
          
          
          switch (searchType) {
            case 'facebook':
              sql += " WHERE fbid = " + id;
              break;
            
            default:
              sql += " WHERE id = " + id;
          }
          
          
          
        }
        conn.query(sql, function(err,rows){
          ret(err,rows);
          conn.end();
        });        
    },
    delete: function(id, ret){
        var conn = GetConnection();
        conn.query("DELETE FROM Person WHERE id = " + id, function(err,rows){
          ret(err);
          conn.end();
          
        });        
    },
    save: function(row, ret){
        var sql;
        var conn = GetConnection();
        //  TODO Sanitize
        if (row.id) {
				  sql = " Update Person "
							+ " Set Name=?, Birthday=?, Height=?, Weight=?, Calorie_eatgoal=?, fbid=? "
						  + " WHERE id = ? ";
			  }else{
				  sql = "INSERT INTO Person "
						  + " (Name, Birthday, Created_at, Height, Weight, Calorie_eatgoal, fbid) "
						  + "VALUES (?, ?, Now(), ?, ?, ?, ? ) ";	
						 
						  
			  }

        conn.query(sql, [row.Name, row.Birthday,row.Height,row.Weight,row.Calorie_eatgoal, row.fbid, row.id],function(err,data){
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
          password: "6666",
          database: "c9"
        });
    return conn;
}
/*
var mysql = require("mysql");

module.exports =  {
    blank: function(){ return {} },
    get: function(id, ret, searchType){
        var conn = GetConnection();
        var sql = 'SELECT P.*, K.Name as TypeName FROM 2015Fall_Persons P Join 2015Fall_Keywords K ON P.TypeId = K.id ';
        if(id){
          switch (searchType) {
            case 'facebook':
              sql += " WHERE P.fbid = " + id;
              break;
            
            default:
              sql += " WHERE P.id = " + id;
          }
          
        }
        conn.query(sql, function(err,rows){
          ret(err,rows);
          conn.end();
        });        
    },
    delete: function(id, ret){
        var conn = GetConnection();
        conn.query("DELETE FROM 2015Fall_Persons WHERE id = " + id, function(err,rows){
          ret(err);
          conn.end();
        });        
    },
    save: function(row, ret){
        var sql;
        var conn = GetConnection();
        
        
        if (row.id) {
				  sql = " Update 2015Fall_Persons "
							+ " Set Name=?, Birthday=?, TypeId=?, fbid=? "
						  + " WHERE id = ? ";
			  }else{
				  sql = "INSERT INTO 2015Fall_Persons "
						  + " (Name, Birthday, created_at, TypeId, fbid) "
						  + "VALUES (?, ?, Now(), ?, ? ) ";				
			  }

        conn.query(sql, [row.Name, row.Birthday, row.TypeId, row.fbid, row.id],function(err,data){
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
          user: "blabla",
          password: "1212",
          database: "c9"
        });
    return conn;
}

*/
