package main

import "fmt"

func main() {
	x := 2

	fmt.Println("条件判断:x =", x)
	if x > 10 {
		fmt.Println("x is greater than 10")
	} else {
		fmt.Println("x is less than 10")
	}
}
