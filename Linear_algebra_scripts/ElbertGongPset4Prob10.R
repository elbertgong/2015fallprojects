library("pracma")

#part a
A <- matrix(c(3,1,3,4,3,6,-4,-1,-4),3); A
w <- c(1,0,0); w
T <- cbind(w, A%*%w, A%*%A%*%w, A%*%A%*%A%*%w); T
rref(T)
# So A^3w = -2w + Aw + 2A^2w, so p(t)= t^3 - 2t^2 - t + 2
# p(t) = (t-2)(t-1)(t+1), so the eigenvalues are 2, 1, and -1
lam1 <- 2; lam2 <- 1; lam3 <- -1
I <- diag(c(1,1,1),3); I
v1 <- (A - lam2*I) %*% (A - lam3*I) %*% w
A%*%v1; lam1*v1
v2 <- (A - lam1*I) %*% (A - lam3*I) %*% w
A%*%v2; lam2*v2
v3 <- (A - lam1*I) %*% (A - lam2*I) %*% w
A%*%v3; lam3*v3

#The eigenvectors and eigenvalues are
v1; lam1
v2; lam2
v3; lam3

#part b
A <- matrix(c(1,1,1,0,3,2,0,-1,0),3); A
w <- c(1,0,0); w
T <- cbind(w, A%*%w, A%*%A%*%w); T
rref(T)
# so A^2w = -2w + 3Aw, so p(t)= t^2 - 3t + 2
# p(t) = (t-2)(t-1), so the eigenvalues are 2 and 1
lam1 <- 2; lam2 <- 1
v1 <- (A - lam2*I) %*% w
A%*%v1; lam1*v1
v2 <- (A - lam1*I) %*% w
A%*%v2; lam2*v2
#But we need to find the last eigenvector in the eigenbasis
# repeat the process with a different basis vector
w <- c(0,0,1); w
T <- cbind(w, A%*%w, A%*%A%*%w); T
rref(T)
# p(t) = (t-2)(t-1) is the same as before
# let's check for a new eigenvector
v3 <- (A - lam2*I) %*% w; v3
# nope, that's the same as one of our existing eigenvectors
v3 <- (A - lam1*I) %*% w; v3
# there's our last eigenvector!
A%*%v3; lam2*v3
#The eigenvalues and eigenvectors are
v1; lam1
v2; lam2
v3; lam1
