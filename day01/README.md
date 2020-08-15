使用var关键字是Go最基本的定义变量方式，与C语言不同的是Go把变量类型放在变量名后面：
```
var variableName type
var vname1, vname2, vname3 type
var variableName type = value
var vname1, vname2, vname3 type= v1, v2, v3
var vname1, vname2, vname3 = v1, v2, v3

vname1, vname2, vname3 := v1, v2, v3
_, b := 34, 35

```
所谓常量，也就是在程序编译阶段就确定下来的值，而程序在运行时无法改变该值。在Go程序中，常量可定义为数值、布尔值或字符串等类型
```
const constantName = value
//如果需要，也可以明确指定常量的类型：
const Pi float32 = 3.1415926
const Pi = 3.1415926
const i = 10000
const MaxThread = 10
const prefix = "astaxie_"

```
在Go中，布尔值的类型为bool，值是true或false，默认为false。
```
//示例代码
var isActive bool  // 全局变量声明
var enabled, disabled = true, false  // 忽略类型的声明
func test() {
    var available bool  // 一般声明
    valid := false      // 简短声明
    available = true    // 赋值操作
}
```
整数类型有无符号和带符号两种。Go同时支持int和uint，这两种类型的长度相同，但具体长度取决于不同编译器的实现。Go里面也有直接定义好位数的类型：rune, int8, int16, int32, int64和byte, uint8, uint16, uint32,uint64。其中rune是int32的别称，byte是uint8的别称。
```
// 需要注意的一点是，这些类型的变量之间不允许互相赋值或操作，不然会在编译时引起编译器报错
var a int8

var b int32

c:=a + b

```
浮点数的类型有float32和float64两种（没有float类型），默认是float64。
```
var c complex64 = 5+5i
//output: (5+5i)
fmt.Printf("Value is: %v", c)
```

Go中的字符串都是采用UTF-8字符集编码。字符串是用一对双引号（""）或反引号（ ）括起来定义，它的类型是string。
```
//示例代码
var frenchHello string  // 声明变量为字符串的一般方法
var emptyString string = ""  // 声明了一个字符串变量，初始化为空字符串
func test() {
    no, yes, maybe := "no", "yes", "maybe"  // 简短声明，同时声明多个变量
    japaneseHello := "Konichiwa"  // 同上
    frenchHello = "Bonjour"  // 常规赋值
}
// 在Go中字符串是不可变的，例如下面的代码编译时会报错：cannot assign to s[0]
var s string = "hello"
s[0] = 'c'

// 但如果真的想要修改怎么办呢？下面的代码可以实现：

s := "hello"
c := []byte(s)  // 将字符串 s 转换为 []byte 类型
c[0] = 'c'
s2 := string(c)  // 再转换回 string 类型
fmt.Printf("%s\n", s2)

s := "hello,"
m := " world"
a := s + m
fmt.Printf("%s\n", a)

s := "hello"
s = "c" + s[1:] // 字符串虽不能更改，但可进行切片操作
fmt.Printf("%s\n", s)

m := `hello
    world`
```
Go内置有一个error类型，专门用来处理错误信息，Go的package里面还专门有一个包errors来处理错误：
```
err := errors.New("emit macho dwarf: elf header corrupted")
if err != nil {
    fmt.Print(err)
}
```
map也就是Python中字典的概念，它的格式为map[keyType]valueType
```
// 声明一个key是字符串，值为int的字典,这种方式的声明需要在使用之前使用make初始化
    numbers := make(map[string]int)
// 另一种map的声明方式
var numbers map[string]int

numbers["one"] = 1  //赋值
numbers["tow"] = 2 //赋值

numbers["three"] = 3 //赋值


fmt.Println("第一个数字是: ", numbers["one"]) // 读取数据

fmt.Println("第二个数字是: ", numbers["tow"]) // 读取数据

fmt.Println("第三个数字是: ", numbers["three"]) // 读取数据
```
这个map就像我们平常看到的表格一样，左边列是key，右边列是值

使用map过程中需要注意的几点：

map是无序的，每次打印出来的map都会不一样，它不能通过index获取，而必须通过key获取
map的长度是不固定的，也就是和slice一样，也是一种引用类型
内置的len函数同样适用于map，返回map拥有的key的数量
map的值可以很方便的修改，通过numbers["one"]=11可以很容易的把key为one的字典值改为11
map和其他基本型别不同，它不是thread-safe，在多个go-routine存取时，必须使用mutex lock机制
map的初始化可以通过key:val的方式初始化值，同时map内置有判断是否存在key的方式

通过delete删除map的元素：
```
// 初始化一个字典
rating := map[string]float32{"C":5, "Go":4.5, "Python":4.5, "C++":2 }
// map有两个返回值，第二个返回值，如果不存在key，那么ok为false，如果存在ok为true
csharpRating, ok := rating["C#"]
if ok {
    fmt.Println("C# is in the map and its rating is ", csharpRating)
} else {
    fmt.Println("We have no rating associated with C# in the map")
}
delete(rating, "C")  // 删除key为C的元素
```
上面说过了，map也是一种引用类型，如果两个map同时指向一个底层，那么一个改变，另一个也相应的改变：
```
m := make(map[string]string)
m["Hello"] = "Bonjour"
m1 := m
m1["Hello"] = "Salut"  // 现在m["hello"]的值已经是Salut了
```
make、new操作
make用于内建类型（map、slice 和channel）的内存分配。new用于各种类型的内存分配。

内建函数new本质上说跟其它语言中的同名函数功能一样：new(T)分配了零值填充的T类型的内存空间，并且返回其地址，即一个*T类型的值。用Go的术语说，它返回了一个指针，指向新分配的类型T的零值。有一点非常重要：
