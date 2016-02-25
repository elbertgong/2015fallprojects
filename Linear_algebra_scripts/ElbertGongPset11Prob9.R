#install.packages("numDeriv")
library(numDeriv)    #for the grad() function

f <- function(v) c(v[1]^.75*v[2]^(1/3)+v[1],v[1]^.25*v[2]^(2/3)+v[2])
f(c(16,8))   #it works: V=32, P=16

fJ <- jacobian(f, c(16,8));fJ
fInvJ <- solve(fJ); fInvJ

#want to find where f(x,y)=(24, 24)
g <- c(24,24)
increment <- g-c(32,16)   #volume 32->24 , profit 16->24
g1 <- c(16,8)+fInvJ%*%increment; g1; f(g1)
increment <- g-f(g1)
g2 <- g1+fInvJ%*%increment; g2; f(g2)
increment <- g-f(g2)
g3 <- g2+fInvJ%*%increment; g3; f(g3)
increment <- g-f(g3)
g4 <- g3+fInvJ%*%increment; g4; f(g4)
increment <- g-f(g4)
g5 <- g4+fInvJ%*%increment; g5; f(g5)
#with 5 iterations of Newton's method, we have gotten extremely close to (24,24)