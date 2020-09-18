package main

import "fmt"

func main() {
    var age int = 23
    if age == 25 {
        fmt.Println("true")
    } else if age < 25 {
        fmt.Println("too small")
    } else {
        fmt.Println("too big")
    }
}