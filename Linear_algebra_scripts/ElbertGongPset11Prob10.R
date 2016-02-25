#install.packages("numDeriv")
library(numDeriv)    #for the grad() function
par(mar = c(2,2,1,1))  #maximize space for graphs

f <- function(x) (x*(x^2 - 1)*(x^2-4) - 1)
#Graph the function on a interval where it has roots
curve(f(x), from = -2, to = 2.1)
abline(h=0, col = "green")

#Find a value that makes f close to zero  and evaluate f and f' there
x0 <- -1.9; f(x0); grad(f, x0)
#Add the tangent line to the plot
curve(f(x0) + grad(f, x0)*(x-x0), col = "red", add = TRUE)
#Solve a linear approximation to find where the tangent line is zero
x1 <- x0 - f(x0)/grad(f, x0); abline(v = x1, col = "red"); f(x1)
#Repeat to improve the approximation
x2 <- x1 - f(x1)/grad(f, x1); abline(v = x2, col = "red", lty = 2); f(x2)
x3 <- x2 - f(x2)/grad(f, x2); abline(v = x3, col = "red", lty = 3); f(x3)
a1 <- x3; x3

#Find the other 4 roots the same way, looking at the graph for good approximations

x0 <- -1.2; f(x0); grad(f, x0)
#Add the tangent line to the plot
curve(f(x0) + grad(f, x0)*(x-x0), col = "red", add = TRUE)
#Solve a linear approximation to find where the tangent line is zero
x1 <- x0 - f(x0)/grad(f, x0); abline(v = x1, col = "red"); f(x1)
#Repeat to improve the approximation
x2 <- x1 - f(x1)/grad(f, x1); abline(v = x2, col = "red", lty = 2); f(x2)
x3 <- x2 - f(x2)/grad(f, x2); abline(v = x3, col = "red", lty = 3); f(x3)
a2 <- x3; x3

x0 <- .2; f(x0); grad(f, x0)
#Add the tangent line to the plot
curve(f(x0) + grad(f, x0)*(x-x0), col = "red", add = TRUE)
#Solve a linear approximation to find where the tangent line is zero
x1 <- x0 - f(x0)/grad(f, x0); abline(v = x1, col = "red"); f(x1)
#Repeat to improve the approximation
x2 <- x1 - f(x1)/grad(f, x1); abline(v = x2, col = "red", lty = 2); f(x2)
x3 <- x2 - f(x2)/grad(f, x2); abline(v = x3, col = "red", lty = 3); f(x3)
a3 <- x3; x3

x0 <- .8; f(x0); grad(f, x0)
#Add the tangent line to the plot
curve(f(x0) + grad(f, x0)*(x-x0), col = "red", add = TRUE)
#Solve a linear approximation to find where the tangent line is zero
x1 <- x0 - f(x0)/grad(f, x0); abline(v = x1, col = "red"); f(x1)
#Repeat to improve the approximation
x2 <- x1 - f(x1)/grad(f, x1); abline(v = x2, col = "red", lty = 2); f(x2)
x3 <- x2 - f(x2)/grad(f, x2); abline(v = x3, col = "red", lty = 3); f(x3)
a4 <- x3; a4

x0 <- 2; f(x0); grad(f, x0)
#Add the tangent line to the plot
curve(f(x0) + grad(f, x0)*(x-x0), col = "red", add = TRUE)
#Solve a linear approximation to find where the tangent line is zero
x1 <- x0 - f(x0)/grad(f, x0); abline(v = x1, col = "red"); f(x1)
#Repeat to improve the approximation
x2 <- x1 - f(x1)/grad(f, x1); abline(v = x2, col = "red", lty = 2); f(x2)
x3 <- x2 - f(x2)/grad(f, x2); abline(v = x3, col = "red", lty = 3); f(x3)
a5 <- x3; a5

a1; a2; a3; a4; a5