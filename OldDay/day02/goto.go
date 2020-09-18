package main

import "fmt"

func main(){
	x :=2
	if x > 10 {
		fmt.Println("x is greater than 10")
	} else {
		fmt.Println("x is less than 10")
	}
	myFunc()
}

func myFunc() {
    i := 0
Here:   //这行的第一个词，以冒号结束作为标签
    println(i)
    i++
    goto Here   //跳转到Here去
}