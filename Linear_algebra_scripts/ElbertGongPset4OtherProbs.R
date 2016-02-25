library("pracma") #for rref()


#2a
v1 <- c(-10,-18); v2 <- c(9,17)
A <- cbind(v1,v2); A
w <- c(1,0); w; A%*%w; A%*%A%*%w
B <- cbind(w,A%*%w,A%*%A%*%w); B
rref(B)

#checking answer
C <- matrix(c(-4,-6,3,5),2); C
C %*% C %*% C


#4a
v1 <- c(.1,.9); v2 <- c(.7,.3)
A <- cbind(v1,v2); A
w <- c(1,0); w; A%*%w; A%*%A%*%w
B <- cbind(w,A%*%w,A%*%A%*%w); B
rref(B)