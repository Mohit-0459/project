<!DOCTYPE html>
<html>
    
<head>
<style>
.button {
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #D62600;
}

.button1:hover {
  background-color: #D62600;
  color: white;
}

.button2 {
  background-color: white; 
  color: black; 
  border: 2px solid #008CBA;
}

.button2:hover {
  background-color: #008CBA;
  color: white;
}
.myDiv {
  border: 5px outset red;
  background-color: lightblue;    
  text-align: center;
}
</style>

</head>
<body>
  
  <div class="myDiv">
<h1>Capstone Project</h1>
<script src="myjavascript.js"></script>
<button class="button button1" onclick="fbLogout()">LOGOUT</button>
</div>


</body>

</html>