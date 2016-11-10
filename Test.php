<!--   	**Game comments**-->
<!--*Please report any bugs or changes you would like-->





<!--**Notes-->
<!--	We can currently detect collisons but it is True|False value which doesn't-->
<!--	help us determine where the collision is-->
<!---->




<!DOCTYPE html>


<?php $pageid = 'game'; include('../../TheQuestion.php'); ?>




<html>
	<head>
		<title>Jeff's Games</title>
        <meta charset="utf-8"/>
		<style>
			canvas {
			    border: 1px solid #d3d3d3;
			    background-color: #f1f1f1;
			    position: relative;
			    width:80%;
			    left:10%;
			    top:40px;
			}
			.scorebutton{
			    position: absolute;
			    top: 7%;
			    left:10.5%;
			    width:80px;
			}
			.picupsbutton{
			    position: absolute;
			    top: 12%;
			    left:10.5%;
			    width:80px;
			}
		
		</style>
	</head>
	<body onload = "init()">
	<script src="sprite.js"></script>
	<script src="gameObjects.js"></script>
	<script src="Jeff.js"></script>
	<script type="text/javascript">
	
	
	var myGame = {
		canvas : document.createElement("canvas"),
        level1 : {
            level1Background : new level1BackgroundObject,
            level1GamePieces : {milk : new MikeMilk(600,720), milk1 : new MikeMilk(1000,720), mike2 : new MikeMilk(1400,720), trash : new trashCan(3000,720)},
            buildMap : function(){
            },
            levelMaker : function(){
                myGame.level1.level1Background.draw();
                for (var gameObject in myGame.level1.level1GamePieces){
                    if(myGame.level1.level1GamePieces[gameObject].visible && viewPoint.inFrame(myGame.level1.level1GamePieces[gameObject])){
                        myGame.level1.level1GamePieces[gameObject].draw();
                    }
                }
                
            }
            
        },
		start : function() {
			this.canvas.width= 1800;
			this.canvas.height= 885;
			this.context = this.canvas.getContext('2d');
			document.body.insertBefore(this.canvas, document.body.childNodes[0]);
			this.interval = setInterval(update, 10);
			window.addEventListener('keydown', function (e) {
        		myGame.keys = (myGame.keys || []);
        		myGame.keys[e.keyCode] = true;
    		})
    		window.addEventListener('keyup', function (e) {
        		myGame.keys[e.keyCode] = false; 
    		})
		},
        stop : function() {
        clearInterval(this.interval); }
		
	}
	
	function init(){
		myGame.start();
        myGame.level1.buildMap();
		
	}
	
	function update(){
		viewPoint.camera(Jeff, myGame.context);
        myGame.level1.levelMaker();
		Jeff.draw(myGame.level1.level1GamePieces);
		
		//document.getElementById("display").innerHTML = "Your score is: " + highscore;
		//document.getElementById("pickups").innerHTML = "Your pickups amount is: " + pickups;
		
		
        if(myFloor.visible){
            myFloor.draw();
        }
        if(myFloor2.visible){
            myFloor2.draw();
        }
	}
	
	brian = new dude(); //Main Character
	myFloor = new floor(400,400,400,100);//Main platform -> testing collision
	myFloor2 = new floor(600,400,100,100);//Main platform -> testing collision

	
	Jeff = new Jeff({
		context: myGame.canvas.getContext("2d"),
		width: 600,
		height: 200,
		numberOfFrames: 4,
		ticksPerFrame: 15,
		xaxis: 100,
		yaxis: 30
		})
    
	var garretBackground1 = new Image;
		garretBackground1.src = "images/Level_1_v2.png";
	
	
	var viewPoint ={
		x1Point : (1920 /2) - 600,
		x2Point : (1920/2) + 600,
		viewPointClearStart: 0,
        viewPointClearEnd: 1920,
		moveCameraRight: function(){
			viewPoint.x1Point += 6;
			viewPoint.x2Point += 6;
			viewPoint.viewPointClearStart +=6;
            viewPoint.viewPointClearEnd +=6;
			myGame.context.translate(- 6,0);
			//updatehighscore();     //his is causing lag on camera motion                   
		},
		moveCameraLeft : function(){
			viewPoint.x1Point -= 6;
			viewPoint.x2Point -= 6;
			viewPoint.viewPointClearStart -= 6;
            viewPoint.viewPointClearEnd -= 6;
			myGame.context.translate(6,0);
		},
		centerCamera : function(gameObject){
            
			if(gameObject.xaxis <= viewPoint.x1Point && this.viewPointClearStart >0){
				viewPoint.moveCameraLeft();
			}else if((gameObject.xaxis + gameObject.fakeWidth) >= viewPoint.x2Point && (this.viewPointClearStart + 1920) < myGame.level1.level1Background.length){
				viewPoint.moveCameraRight();
			}
		},
		camera : function(gameObject, context){
			viewPoint.centerCamera(gameObject);
			context.clearRect(this.viewPointClearStart,0, (this.viewPointClearStart + 1920),900)
			
		},
		gameMaker : function (){
			var level1 = {};
            var level2 = {};
			
		},
        inFrame :function (gamePiece){
            if(gamePiece.xaxis >= this.viewPointClearStart && gamePiece.xaxis <= this.viewPointClearEnd){
                return true;
            }
        }
		
	}

	function SaveCurrentScoreToCookie(){
		
		//alert(highscore);
		
		//EddyHighscore = highscore
		//document.cookie = 'EddyHighscore='+EddyHighscore;
		document.cookie="EddyHighscore= " + highscore + ";path=/";
		
		

	}

    


	</script>
	
	<?php include('../../scroll.php'); ?>
	
	<div class='scorebutton'>
		<a type="button" id="display" class=" btn btn-primary btn-sm "><span class=" " aria-hidden="true"></span> </a> 

	</div>
	<div class='picupsbutton'>
		<a type="button" id="pickups" class=" btn btn-primary btn-sm "><span class="" aria-hidden="true"></span>  </a> 

	</div>			
	
	<div class='exitbutton'>
	  <a href="../../AskTheQuestion.php" type="button" onclick="SaveCurrentScoreToCookie()" class=" btn btn-danger btn-sm "><span class=" " aria-hidden="true"></span> X </a> 
	</div>		
	
	
	</body>
	
	

	
</html>