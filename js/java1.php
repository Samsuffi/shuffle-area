<?php /******************************************

Romain ABDILLA
10/08/2018

shumbahuur.fr
/js/java1.php

/***********************************************/
?><!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <!--<link href="global.css" rel="stylesheet">-->
  <title>Index</title>
  <style>
    canvas{
      border: 1px solid black;
    }
  </style>
</head>
<body>
  <nav>
    <ul>
      <li><a href="JS/java1.php">Java 1</a></li>
    </ul>
  </nav>
  <main>
    <!--<canvas id="canvas" width="10" height="10">
    </canvas>-->
  </main>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.6.1/p5.js"></script>
<script>

var s;
var scl = 40;
var food;

function setup(){
  createCanvas(400,400);
  s = new Snake();
  frameRate(10);
  pickLocation();

}

function pickLocation(){
  var cols = floor(width/scl);
  var rows = floor(height/scl);
  food = createVector(floor(random(cols)), floor(random(rows)));
  food.mult(scl);
}

function draw(){
  background(51);
  s.death();
  s.update();
  s.show();

  if(s.eat(food)){
    pickLocation();
  }

  fill(255,100,100);
  rect(food.x, food.y, scl, scl);
}

function keyPressed(){
  if(keyCode === UP_ARROW){
    s.dir(0,-1);
  } else if(keyCode === DOWN_ARROW){
    s.dir(0,1);
  } else if(keyCode === LEFT_ARROW){
    s.dir(-1,0);
  } else if(keyCode === RIGHT_ARROW){
    s.dir(1,0);
  }
}

function Snake(){
  this.x = 0;
  this.y = 0;
  this.xspeed = 1;
  this.yspeed = 0;
  this.total = 0;
  this.tail = [];

  this.eat = function(pos){
    var d = dist(this.x, this.y, pos.x, pos.y);
    if(d < 1){
      this.total++;
      return true;
    } else {
      return false;
    }
  }

  this.death = function(){
    for(var i=0; i < this.tail.length; i++){
      var pos = this.tail[i];
      var d = dist(this.x, this.y, pos.x, pos.y);
      if(d < 1){
        console.log('Starting over');
        this.total = 0;
        this.tail = [];
      }

    }
  }

  this.dir = function(x,y){
    this.xspeed = x;
    this.yspeed = y;
  }

  this.update = function(){
    if(this.total === this.tail.length){
      for(var i = 0; i < this.tail.length -1; i++){
          this.tail[i] = this.tail[i+1];
      }
    }
    this.tail[this.total-1] = createVector(this.x, this.y)

    this.x = this.x + this.xspeed * scl;
    this.y = this.y + this.yspeed * scl;

    this.x = constrain(this.x, 0, width-scl);
    this.y = constrain(this.y, 0, height-scl);

  }

  this.show = function(){
    fill(255);

    for(var i = 0; i < this.total; i++){
        rect(this.tail[i].x, this.tail[i].y, scl, scl);
    }

    rect(this.x, this.y, scl,scl);
  }
}


</script>
</html>
