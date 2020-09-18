package main 

import "fmt"

func main() {
    for m := 1; m < 10; m++ {
    /*    fmt.Printf("第%d次：\n",m) */
        for n := 1; n <= m; n++ {
            fmt.Printf("%dx%d=%d ",n,m,m*n)
        }
        fmt.Println("")
    }
}