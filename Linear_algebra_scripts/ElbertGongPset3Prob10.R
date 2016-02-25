source("1.2L-VectorLibrary (1).R")
library("pracma")

w1 <- c(1,1,1); w2 <- c(1,0,1); w3 <- c(3,4,12)
v1 <- w1/Norm(w1); v1; Norm(v1)

x <- w2 - (w2%.%v1)*v1; x%.% v1
v2 <- x/Norm(x); v2

x <- w3 - (w3%.%v1)*v1 - (w3%.%v2)*v2; x%.% v1; x%.% v2
v3 <- x/Norm(x); v3

A <- cbind(v1,v2, v3); A
round(t(A)%*%A, digits = 6)
#so A is indeed an isometry because the transpose of A equals the inverse
det(A)
#so A is a reflection matrix. We need to flip the colums

B <- cbind(v1,v3,v2); B
round(t(B)%*%B, digits = 6)
det(B)
#so B is a rotation matrix, as desired
