library("pracma")

A <- matrix(c(5,-1,0,1,3,0,1,-1,4),3); A      
w <- c(1,0,0); w; A%*%w; A%*%A%*%w
T <- cbind( w, A%*%w, A%*%A%*%w); T 
rref(T)
#So A^2w = -16Iw + 8Aw; (A^2 -8A + 16I)w = 0
#The polynomial is p(t) = t^2 - 8t - 16 = (t-4)^2
I <- diag(c(1,1,1))
v<-(A-4*I)%*% w; v   #an eigenvector with eigenvalue 4
A%*% v; 4*v    #check that it's an eigenvector

#We look for a second independent eigenvector.
w <- c(-1,0,1); w; A%*%w
T <- cbind( w, A%*%w); T 
rref(T)
# Aw = 4w; (A-4I)w = 0
# p(t) = t-4
# our original vector itself was an eigenvector!
A%*%w; 4*w

#We look in vain for a third independent eigenvector- it cannot be found.
w <- c(17.123,49.193,-22.875); w; A%*%w; A%*%A%*%w 
#choose any "w" you want, it won't give you a unique eigenvector
T <- cbind(w, A%*%w, A%*%A%*%w); T
rref(T)
# This matches one of the 2 row-reduced matrices we've already seen
# so we know it's going to give us the same eigenvalue and eigenvector



#We can express A as the sum of a diagonal matrix and N, the nilpotent matrix
D <- matrix(c(4,0,0,0,4,0,0,0,4),3); D
N <- A - D; N
N%*%N
#N is indeed the nilpotent matrix
