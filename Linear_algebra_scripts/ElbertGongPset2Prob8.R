source("1.2L-VectorLibrary (1).R")  #load the vector library
#A
#Boston is at latitude 42.35, longitude -71.05
latB <- 42.35; longB <- -71.05
#Naples is at latitude 40.84, longitude 14.26
latN <- 40.84; longN <- 14.26
#Dublin is at latitude 53.35, longitude -6.26
latD <- 53.35; longD <- -6.26
B <- c(Cos(latB)*Cos(longB),Cos(latB)*Sin(longB),Sin(latB)); B 
N <- c(Cos(latN)*Cos(longN),Cos(latN)*Sin(longN),Sin(latN)); N
D <- c(Cos(latD)*Cos(longD),Cos(latD)*Sin(longN),Sin(latD)); D



#B
degreesBN <- angleBetween(B,N); degreesBN
kilometersBN <- 10000*degreesBN/90
kilometersBN   #the trip is about 6767 km

degreesBD <- angleBetween(B,D); degreesBD
kilometersBD <- 10000*degreesBD/90
kilometersBD
degreesDN <- angleBetween(D,N); degreesDN
kilometersDN <- 10000*degreesDN/90
kilometersDN
kilometersBD + kilometersDN #the trip with Dublin layover is about 7416 km



#C
#If all 3 vectors lie in the same plane, the dot product of "the cross product 
#of 2 vectors" with the third vector will be 0

B %x% N %.% D
#Dublin is not on the great-circle route between Boston and Naples

