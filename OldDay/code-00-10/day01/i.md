文件结构
```
./myMath
    myMath1.go
    myMath2.go
./Test
    helloworld.go 
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

关于包，根据本地测试得出以下几点：

 文件名与包名没有直接关系，不一定要将文件名与包名定成同一个。
 文件夹名与包名没有直接关系，并非需要一致。
 同一个文件夹下的文件只能有一个包名，否则编译报错。