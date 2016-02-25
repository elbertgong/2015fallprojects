plot(NULL, xlim = c(-3,3), ylim = c(-3,3), xlab = "", ylab= "",axes = FALSE) 
I1 <- c(-2,2); I2 <- c(-2,-2); I3 <- c(2,2); I4 <- c(2,-2)
points(c(I1[1],I2[1],I3[1],I4[1]),c(I1[2],I2[2],I3[2],I4[2]))
text(I1[1]-0.2,I1[2]+0.2,"Middle Kingdom"); text(I2[1]-0.2,I2[2]-0.2,"Tibet");
text(I3[1]+0.2,I3[2]+0.2,"Shanghai"); text(I4[1]+0.2,I4[2]-0.2,"Hunan");

#From island 1 there are trains to islands 2, 3, and 4
arrows(I1[1],I1[2],I2[1],I2[2]); arrows(I1[1],I1[2],I3[1],I3[2]);
arrows(I1[1],I1[2],I4[1],I4[2]);
c1 <- c(0,1,1,1)
#From island 2 there are trains to islands 1 and 3
arrows(I2[1],I2[2],I1[1],I1[2]); arrows(I2[1],I2[2],I3[1],I3[2]);
c2 <- c(1,0,1,0)
#From island 3 there are trains to islands 1 and 4
arrows(I3[1],I3[2],I1[1],I1[2]); arrows(I3[1],I3[2],I4[1],I4[2]);
c3 <- c(1,0,0,1)
#From island 4 there are trains to islands 1 and 2
arrows(I4[1],I4[2],I1[1],I1[2]); arrows(I4[1],I4[2],I2[1],I2[2]);
c4 <-c(1,1,0,0)

A <- cbind(c1,c2,c3,c4); A
B <- A %*% A; B
C <- B %*% B; C
#There are 7 different sequences of 4-rail rides from Tibet to Middle Kingdom
