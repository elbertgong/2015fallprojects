library(pracma)   #for the rref() row-reduction function
r1 <- c(3,0,4,0,2,2); r2 <- c(1,1,3,3,2,1); r3 <- c(0,2,1,1,4,2); r4 <- c(1,0,2,0,3,4)

"%+5%" <- function(x,y) (x+y) %%5  #addition
"%-5%" <- function(x,y) (x-y) %%5  #subtraction
"%*5%" <- function(x,y) (x*y) %%5  #multiplication
"%/5%" <- function(x,y) (x*y*y*y) %%5  #division

A <- rbind(r1,r2,r3,r4); A
r1 <- r1 %/5% 3; rbind(r1,r2,r3,r4)
r2 <- r2 %-5% r1; r4 <- r4 %-5% r1; rbind(r1,r2,r3,r4)
r3 <- r3 %-5% (2 %*5% r2); rbind(r1,r2,r3,r4)
r4 <- r4 %-5% (4 %*5% r3); r1 <- r1 %-5% (3 %*5% r3); rbind(r1,r2,r3,r4)
r4 <- 3 %*5% r4; rbind(r1,r2,r3,r4)
r2 <- r2 %-5% (3 %*5% r4); r3 <- r3 %-5% (3 %*5% r4); rbind(r1,r2,r3,r4)

#To find a basis for the image
#Rows 1, 2, 3, and 5 of the original matrix are nonpivotal
#Thus a basis for the image consists of the vectors:
# [3,1,0,1], [0,1,2,0], [4,3,1,2], and [2,2,4,3]

#To find a basis for the kernel
#Rows 4 and 6 are nonpivotal
#The kernel's basis will be spanned by 2 linearly independent vectors of the form
#[x1,y1,z1,1,w1,0], and [x2,y2,z2,0,w2,1]

#We start with k1
#x1 = 0, y1+3 = 0 -> y1 = -3, z1 + 0 = 0 -> z1 = 0, w1 + 0 = 0 -> w1 = 0
k1 <- c(0,-3,0,1,0,0)
A%*%k1
#In Z5, any multiple of 5 or -5 is equivalent to a 0. 
#Thus A%*%k1 does equal the zero vector, and k1 is in the kernel

#Then to k2
#x2 = 0, y2 + 0 = 0 -> y2 = 0, z2 + 1 = 0 -> z2 = -1, w2 + 4 = 0 -> w2 = -4
k2 <- c(0,0,-1,0,-4,1)
A%*%k2
#By the same reasoning as before, A%*%k2 does equal the zero vector
#And k2 is in the kernel

#Btw, the homework said I didn't need to work problem 7 if I did this one
