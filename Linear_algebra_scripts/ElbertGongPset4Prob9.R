library("pracma")
A<- matrix(c(4,-1,1,-1,3,2,1,2,-3),3); A
identical(t(A),A)    #it is symmetric
w <- c(1,0,0)
T <- cbind(w, A%*%w, A%*%A%*%w, A%*%A%*%A%*%w); T
rref(T)
pCoef <- rref(T)[,4]  #the last column
p <- function(t) t^3 - pCoef[3]*t^2 - pCoef[2]*t - pCoef[1] 
curve(p(x), from = -4, to =5); abline(h=0, col="red")
#Now we have to find the four eigenvalues
lam1 <- uniroot(p, c(4,5))$root;lam1; p(lam1)
lam2 <- uniroot(p, c(2,4))$root;lam2; p(lam2)
lam3 <- uniroot(p, c(-4,-3))$root;lam3; p(lam3)

#We can compare with the built-in function
eigen(A)$values
lam1; lam2; lam3

I <- diag(c(1,1,1)); I
v <- (A-lam2*I )%*%(A-lam3*I )%*%w; v1<-v/sqrt(sum(v^2))
A%*%v1; lam1*v1    #it checks!
v  <- (A-lam1*I )%*%(A-lam3*I )%*%w; v2<-v/sqrt(sum(v^2))
v  <- (A-lam1*I )%*%(A-lam2*I )%*%w; v3<-v/sqrt(sum(v^2))
P <- cbind(v1,v2,v3); PInv <-solve(P); D <- diag(c(lam1,lam2,lam3))

round(P%*%D%*%PInv, digits = 4);A  
#we diagonalized A!!
round(t(P) %*%P, digits = 4)   
#the columns are orthonormal
eigen(A)$vectors; P            
#and we agree with the built-in function
#the built-in function's eigenvectors are all multiples of our eigenvectors

