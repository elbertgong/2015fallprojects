pars<-par(mar=c(1,1,1,1)+0.1, pch=20)  #set up narrow margins
plot(NULL, xlim = c(0,5), ylim = c(-1,5), xlab = "", ylab= "", asp = 1, axes = FALSE)
axis(1,pos = 0); axis(2,pos = 0) #set up axes at left asnd bottom

#when v1 gets rotated counterclockwise, M is positive
v1 <- c(5,1); v2 <- c(4,4); M <-cbind(v1,v2); M
arrows(0,0, v1[1], v1[2], col = "green")
arrows(0,0, v2[1], v2[2], col = "red")
det(M)

plot(NULL, xlim = c(0,5), ylim = c(-1,5), xlab = "", ylab= "", asp = 1, axes = FALSE)
axis(1,pos = 0); axis(2,pos = 0)
#when v1 gets rotated clockwise, M is negative
v1 <- c(-2,4); v2 <- c(1,2); M <-cbind(v1, v2); M
arrows(0,0, v1[1], v1[2], col = "green")
arrows(0,0, v2[1], v2[2], col = "red")
det(M)

plot(NULL, xlim = c(0,5), ylim = c(-1,5), xlab = "", ylab= "", asp = 1, axes = FALSE)
axis(1,pos = 0); axis(2,pos = 0)
#when v1 and v2 align, M is zero
v1 <- c(3,2); v2 <- c(6,4); M <-cbind(v1, v2); M
arrows(0,0, v1[1], v1[2], col = "green")
arrows(0,0, v2[1], v2[2], col = "red")
det(M)