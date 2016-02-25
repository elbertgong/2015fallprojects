#A
source("1.2L-VectorLibrary (1).R")  #load the vector library
plot(NULL, xlim=c(0,40),  ylim =c(0,30), asp =1, axes = FALSE ) #make empty plot
axis(1,pos = 0); axis(2,pos = 0) #set up axes at left and bottom
#The aspect ratio must be 1 or the angles will look wrong!

make2Dvec <- function(len, angle) {
  c(len*cos(angle*pi/180),len*sin(angle*pi/180))
}

O <- c(0,0)  #starting point
#vector pointing to where the hole is

v0 <- make2Dvec(30,32); v0
P0 <- O + v0
arrows(O[1],O[2],P0[1],P0[2], col = "red")

v1 <- make2Dvec(25,22); v1
P1 <- O + v1 #after first shot
arrows(O[1],O[2],P1[1],P1[2], col = "green")

v2 <- make2Dvec(8,60); v2
P2 <- P1 + v2 #after second shot
arrows(P1[1],P1[2],P2[1],P2[2], col = "blue")

v3 <- v0 - v1 - v2; v3

Norm(v3)
#Your ball is approx 1.78 yards away from the hole!


#B
plot(NULL, xlim = c(-1,1), ylim = c(-1,1), xlab = "x", ylab= "y", asp =1,axes = FALSE)
axis(1,pos = 0); axis(2,pos = 0)
refMat <- function(a) matrix(c(Cos(2*a),Sin(2*a),Sin(2*a),-Cos(2*a)),2)

F40 <- refMat(40)
F30 <- refMat(30)
F80 <- refMat(80)
F90 <- refMat(90); F90
Ffinal <- F80 %*% F30 %*% F40; Ffinal
#These matrices are both the same matrix.

#Watch how the vector pointing to (1,0) is transformed by the 3 reflections
v4 <- c(1,0)
arrows(0,0, v4[1], v4[2], col = "red") 
abline(0, Tan(40))
v5 <- F40 %*% v4
arrows(0,0,v5[1],v5[2], col = "orange")
abline(0, Tan(30))
v6 <- F30 %*% v5
arrows(0,0,v6[1],v6[2], col= "yellow")
abline(0, Tan(80))
v7 <- F80 %*% v6
arrows(0,0,v7[1],v7[2], col= "green")

#Now what about the same vector transformed by a single reflection
v8 <- F90 %*% v4
arrows(0, 0, v8[1], v8[2], col = "blue")
