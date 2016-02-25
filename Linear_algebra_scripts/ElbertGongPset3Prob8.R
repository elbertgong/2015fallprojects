library(pracma)
A <- matrix(c(2,1,2,1,-3,-2,0,-5,-7,-4,-4,-7,5,3,2,6,2,1,1,2,-2,-2,3,-7),4); A
rref(A)
#From the row reduced matrix
#x5 = 1
#Columns for x3 and x4 are non-pivotal, so
#Choose any x3 and x4, and
#x1 = 1 +2x3 - x4
#x2 = 2 + x4 - x3
