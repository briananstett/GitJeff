	var Jeff = function(options){
		//options you must send are ticks per frame, number of frames, context, width, height, image
		this.frameindex = 0;
		this.tickCount = 0;
		this.ticksPerFrame= options.ticksPerFrame; // how man ticks before changing frame
		this.numberOffFrames = options.numberOfFrames; // how many frames/images in the sprite doc
		this.context = options.context; //where to to draw the sprite--> pass the main game board
		this.width = options.width; // width of the ENTIRE sprite page
		this.fakeWidth = this.width/ this.numberOffFrames; //"Camera ready width" the width of any given frame in the sprite
		this.height = options.height; //height of the ENTIRE sprite page
		this.imageRight = options.imageRight; //the actual image of the sprite
		this.imageLeft = options.imageLeft;
		this.yaxis = options.yaxis;
		this.xaxis= options.xaxis; 
		//*********************************
		this.defaultSpeed = 6; //x movement speed
		this.gravity = 0.15;
		this.gravitySpeed =0;
		this.allowJump = false;
		this.jumpVelocity = 0;
		this.jumpSpeed = -9
		this.visible = true;
		
		
		
		this.spriteUpdateDraw = function(direction){
			if (direction){
		    	this.tickCount +=1;
        			if (this.tickCount > this.ticksPerFrame){
        				this.tickCount = 0;
        				if (this.frameindex < this.numberOffFrames - 1){
        					this.frameindex +=1;	
        				}else{
        					this.frameindex = 0;
        				}
        			}
			    
			}
			//****************************************************
			if(direction == "left"){
				this.context.drawImage(
				this.imageLeft,
				//new 
				this.frameindex * this.width / this.numberOffFrames,
				0,
				this.width /this.numberOffFrames,
				this.height,
				this.xaxis,
				this.yaxis,
				this.width / this.numberOffFrames,
				this.height
				);
				
			}else if (direction == "right"){
				this.context.drawImage(
				this.imageRight,
				//new 
				this.frameindex * this.width / this.numberOffFrames,
				0,
				this.width /this.numberOffFrames,
				this.height,
				this.xaxis,
				this.yaxis,
				this.width / this.numberOffFrames,
				this.height
				);
			}else if (direction == "jump"){
			    this.context.drawImage(
				this.imageRight,
				//new 
				this.frameindex * this.width / this.numberOffFrames,
				0,
				this.width /this.numberOffFrames,
				this.height,
				this.xaxis,
				this.yaxis,
				this.width / this.numberOffFrames,
				this.height
				);
			}else{
		    	this.context.drawImage(
    				this.imageRight,
    				//new 
    				this.frameindex * this.width / this.numberOffFrames,
    				0,
    				this.width /this.numberOffFrames,
    				this.height,
    				this.xaxis,
    				this.yaxis,
    				this.width / this.numberOffFrames,
    				this.height
				);
			}
		};
		
		
		this.gravityFunction = function(){
		    if (this.yaxis + this.height >(myGame.canvas.height - 30)){
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
				 this.spriteUpdateDraw("jump");
			}
		}
		
		
		this.jump = function(){
			this.jumpVelocity = this.jumpSpeed;
		}
		
		
		this.collision = function(gamePiece){
			var myleft = this.xaxis;
			var myright = this.xaxis + (this.fakeWidth - 30);
			var mytop = this.yaxis;
			var mybottom = this.yaxis + this.height;
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
		
		
		this.draw = function(){
		    this.xspeed = 0;
			this.yspeed =0;
		    if (myGame.keys && myGame.keys[37]) {
		    	if(this.allowJump){
		        	this.spriteUpdateDraw("left");
		    	}
		    	this.xspeed = - this.defaultSpeed;
			}
			if (myGame.keys && myGame.keys[39]) {
		    	if(this.allowJump){
		        	this.spriteUpdateDraw("right");
		    	}
			    this.xspeed = this.defaultSpeed;
			    }
			if (myGame.keys && myGame.keys[32]) {
				  if(this.allowJump){
				 	this.jump();
				  	this.allowJump = false;
				 }
			}else{ this.spriteUpdateDraw();}
		    this.xaxis += this.xspeed;
			this.yaxis += this.yspeed + this.gravitySpeed + this.jumpVelocity;
			if(arguments.length >0){
				for (i=0;i<arguments.length;i++){
						//console.log(this.collision(arguments[i]));\
						if(this.collision(arguments[i])){
							console.log(this.collision(arguments[i]));
							arguments[i].visible = false;
						}
				}
			}
			this.gravityFunction();
			
		}
	}
	