<!--   	**Game comments**-->
<!--*Please report any bugs or changes you would like-->





<!--**Notes-->
<!--	We can currently detect collisons but it is True|False value which doesn't-->
<!--	help us determine where the collision is-->
<!---->




<!DOCTYPE html>
<html>
	<head>
		<title>Geek Runner</title>
		<style>
			canvas {
		    border: 1px solid #d3d3d3;
		    background-color: #f1f1f1;
		    width:90%;height:100%;
		    left:5%;
		    position: relative;
		    top:40px;
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
		}
		
	}
	
	function init(){
		myGame.start();
		
	}
	
	function update(){
		viewPoint.camera(Jeff, myGame.context);
		myGame.context.drawImage(garretBackground1,0,-120);
		myGame.context.drawImage(garretBackground1,1918,-120);
		myGame.context.drawImage(background2,0 , - 120);
		myGame.context.drawImage(background1, 0, - 120);
		Jeff.draw(myFloor,myFloor2);
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
	JeffImageRight = new Image;
		JeffImageRight.src = "images/Jeff_running_v1.png";
	JeffImageLeft = new Image;
		JeffImageLeft.src = "images/Jeff_running_v1_left.png";
	StandLeft = new Image;
		StandLeft.sr = "images/stand_left.png";
	StandRight = new Image;
		StandRight.sr = "images/stand_right.png";
	
	Jeff = new Jeff({
		context: myGame.canvas.getContext("2d"),
		width: 522,
		height: 189,
		imageRight: JeffImageRight,
		imageLeft: JeffImageLeft,
		imageStandLeft: StandLeft,
		imageStandRight: StandRight,
		numberOfFrames: 4,
		ticksPerFrame: 15,
		xaxis: 900,
		yaxis: 30
		})
	background1 = new Image;
		background1.src = "images/city/layer_01_1920 x 1080.png";
	background2 = new Image;
		background2.src = "images/city/layer_02_1920 x 1080.png";
	background3 = new Image;
		background3.src = "images/city/layer_03_1920 x 1080.png";
	background4 = new Image;
		background4.src = "images/city/layer_04_1920 x 1080.png";
	background5 = new Image;
		background5.src = "images/city/layer_05_1920 x 1080.png";
	background6 = new Image;
		background6.src = "images/city/layer_06_1920 x 1080.png";
	background7 = new Image;
		background7.src = "images/city/layer_07_1920 x 1080.png";
	background8 = new Image;
		background8.src = "images/city/layer_08_1920 x 1080.png";
	var garretBackground1 = new Image;
		garretBackground1.src = "images/background_1.png";
	var CitypngArray = ["images/city/layer_01_1920 x 1080.png",
				"images/city/layer_02_1920 x 1080.png",
				"images/city/layer_03_1920 x 1080.png",
				"images/city/layer_04_1920 x 1080.png",
				"images/city/layer_05_1920 x 1080.png",
				"images/city/layer_06_1920 x 1080.png",
				"images/city/layer_07_1920 x 1080.png",
				"images/city/layer_08_1920 x 1080.png"
	];
	var JeffBackgroundPNGArray = ["images/city/background_1.png"];
	
	
	var viewPoint ={
		x1Point : (1920 /2) - 600,
		x2Point : (1920/2) + 600,
		viewPointClearStart: 0,
		moveCameraRight: function(){
			viewPoint.x1Point += 6;
			viewPoint.x2Point += 6;
			viewPoint.viewPointClearStart +=6;
			myGame.context.translate(- 6,0);
		},
		moveCameraLeft : function(){
			viewPoint.x1Point -= 6;
			viewPoint.x2Point -= 6;
			viewPoint.viewPointClearStart -= 6;
			myGame.context.translate(6,0);
		},
		centerCamera : function(gameObject){
			if(gameObject.xaxis <= viewPoint.x1Point){
				viewPoint.moveCameraLeft();
			}else if((gameObject.xaxis + gameObject.fakeWidth) >= viewPoint.x2Point){
				viewPoint.moveCameraRight();
			}
		},
		camera : function(gameObject, context){
			viewPoint.centerCamera(gameObject);
			context.clearRect(this.viewPointClearStart,0, (this.viewPointClearStart + 1900),900)
			
		},
		setScene : function (world){
			
			
		}
		
	}

	

    


	</script>
	</body>
	
	

	
</html>