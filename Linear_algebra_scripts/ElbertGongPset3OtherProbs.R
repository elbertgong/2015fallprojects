#Prob 1
library("pracma")
"%+5%" <- function(x,y) (x+y) %%5  #addition
"%-5%" <- function(x,y) (x-y) %%5  #subtraction
"%*5%" <- function(x,y) (x*y) %%5  #multiplication
"%/5%" <- function(x,y) (x*y*y*y) %%5  #division

r1 <- c(2,4,1,2); r2 <- c(3,1,0,1); r3 <- c(0,3,2,3); A <- rbind(r1,r2,r3); A
r1 <- r1 %/5% 2; rbind(r1,r2,r3)
r2 <- r2 %-5% (3 %*5% r1); rbind(r1,r2,r3)
temp <- r3; r3 <- r2; r2 <- temp; rbind(r1,r2,r3)
r2 <- r2 %/5% 3; rbind(r1,r2,r3)
r1 <- r1 %-5% (2 %*5% r2); rbind(r1,r2,r3)
r2 <- r2 %-5% (4 %*5% r3); rbind(r1,r2,r3) #row reduced form
#x=4, y=4, z=3



#Prob 2a
r1 <- c(1,0,2); r2 <- c(0,2,2); r3 <- c(-1,2,0)
A <- rbind(r1,r2,r3); A
E1 <- matrix(c(1,0,0,0,1/2,0,0,0,1),3); E1 #multiplies row 2 by 1/2
E1%*%A
E2 <- matrix(c(1,0,1,0,1,0,0,0,1),3); E2 #adds row 1 to row 3
E2%*%E1%*%A
E3 <- matrix(c(1,0,0,0,1,-2,0,0,1),3); E3 #subtracts twice row 2 from row 3
E3%*%E2%*%E1%*%A #row reduced form

#to find the vector not in the span
v1 <- c(0,0,1); v1
B <- solve(E3%*%E2%*%E1); B
B%*%v1
#vector [0,0,1] is not in the span

#Prob 2c
#the cross product of two of the vectors is orthogonal to those vectors
v1 <- c(1,1,-1); v2 <- c(0,2,2); v3 <- c(2,4,0)
A <- v2 %x% v3; A
A%*%v1
A%*%v2
A%*%v3
#checking that it's not in the span
Q <- matrix(c(1,1,-1,0,2,2,2,4,0,-8,4,-4),3); Q
rref(Q)
#the 0 0 0 1 in the last column confirms that A is not in the span




#Prob 3
A <- matrix(c(1,2,3,4,2,7,7,8,11,21,18,38),3); A
rref(A)
#2 cookies, 3 cakes, 1 brownie




#Prob 4
A <- matrix(c(1,2,0,0,1,1,-1,1,2),3); A
E1 <- matrix(c(1,0,0,0,3,0,0,0,1),3); E1
E2 <- matrix(c(1,0,0,0,0,1,0,1,0),3); E2
E3 <- matrix(c(1,0,2,0,1,0,0,0,1),3); E3
E1%*%A
E2%*%A
E3%*%A
#part c
A%*%E1
A%*%E2
A%*%E3

