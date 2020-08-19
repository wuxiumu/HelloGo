文件结构
```
./myMath
    myMath1.go
    myMath2.go
./Test
    helloworld.gosssssss
````
myMath1.go
```
package mathClass
func Add(x,y int) int {
    return x + y
}
```
myMath2.go
```
package mathClass
func Sub(x,y int) int {
    return x - y
}
```
helloworld.go
```
package main
import (
    "fmt"
    "./myMath"
)

func main(){
    fmt.Println(mathClass.Add(1,1))
    fmt.Println(mathClass.Sub(1,1))
}
```
## import
import 导入包的几种方式：点，别名与下划线

相对路径     import   "./model"  //当前文件同一目录的model目录，但是不建议这种方式import

绝对路径    import   "shorturl/model"  //加载GOPATH/src/shorturl/model模块