//*******************************************Main Character*************************
	var dude = function(){
		this.xaxis= 600; //x pos
		this.yaxis= 100; //y pos
		this.defaultSpeed = 6; //x movement speed
		this.character = new Image();
		this.character.src = "images/Geek-Character.png";
		this.gravity = 0.15;
		this.gravitySpeed =0;
		this.allowJump = false;
		this.jumpVelocity = 0;
		this.jumpSpeed = -9
		this.width = 345;
		this.visible = true;
		//draw the geek
		this.draw = function (){
			//movement utiltiy
			this.xspeed = 0;
			this.yspeed =0;
			//set movement speed
			if (myGame.keys && myGame.keys[37]) {this.xspeed = - this.defaultSpeed; }
			if (myGame.keys && myGame.keys[39]) {this.xspeed = this.defaultSpeed; }
			//if (myGame.keys && myGame.keys[38]) {this.yspeed = -4; }
			//if (myGame.keys && myGame.keys[40]) {{this.yspeed = 3; }}
			if (myGame.keys && myGame.keys[32]) {
				 if(this.allowJump){
					this.jump();
				 	this.allowJump = false;
				 }
			
			}
			
			this.xaxis += this.xspeed;
			this.yaxis += this.yspeed + this.gravitySpeed + this.jumpVelocity;
			//actuall moving part NOTE: Collision should be 
			if(arguments.length >0){
				for (i=0;i<arguments.length;i++){
						//console.log(this.collision(arguments[i]));\
						if(this.collision(arguments[i])){
							console.log(this.collision(arguments[i]));
							arguments[i].visible = false;
						}
				}
			}



			if (this.yaxis + 300 >(myGame.canvas.height - 30)){
				//hit bottom
				 if (this.allowJump == false){
				 	this.gravitySpeed = 0;
				 	this.jumpVelocity = 0;
				 	this.allowJump = true;
				}
				 if (this.allowJump){
					this.gravitySpeed = 0;
				}
				
			} else{
				this.gravitySpeed += this.gravity;
			}
			
			
		
		//draw the image
		myGame.context.drawImage(this.character,this.xaxis ,this.yaxis);
		}
		this.jump = function(){
			this.jumpVelocity = this.jumpSpeed;
		}
		
		this.collision = function(gamePiece){
			var myleft = this.xaxis+165;
			var myright = this.xaxis+165+180;
			var mytop = this.yaxis;
			var mybottom = this.yaxis+310;
			var otherleft = gamePiece.xaxis;
			var otherright = gamePiece.xaxis + gamePiece.width;
			var othertop = gamePiece.yaxis;
			var otherbottom = gamePiece.yaxis + gamePiece.height;
			//uncompleted collision
			if (((mybottom < othertop) ||
               (mytop > otherbottom) ||
               (myright < otherleft) ||
               (myleft > otherright))) {
               	return false;

    	}
    	else if(gamePiece.visible == true){
    		return gamePiece.charID;
    	}

	}
	}
//Floor
	function floor(x, y, width, height){
		this.xaxis = x;
		this.yaxis = y;
		this.width = width;
		this.height = height;
		this.charID = 2;
		this.visible = true;
		this.draw = function(){
			myGame.context.fillRect(this.xaxis,this.yaxis,this.width,this.height);	
		}
	}
	