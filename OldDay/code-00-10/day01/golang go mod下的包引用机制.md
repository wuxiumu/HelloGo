首先在gogo目录下 go mod init gogo 声明gogo目录为gogo module

其他的引用都基于module gogo进行引用

```

文件结构:

gogo

    --Test

        --helloworld.go

    --myMath

        --myMath1.go--myMath2.go

测试代码:

// helloworld.go

package main

import (

"fmt"

"gogo/myMath"

)

func main(){   

    fmt.Println("Hello World!")    

    fmt.Println(mathClass.Add(1,1))    

    fmt.Println(mathClass.Sub(1,1))

}

// myMath1.go

package mathClass

func Add(x,y int) int {    

    return x + y

}

// myMath2.go

package mathClass

func Sub(x,y int) int {  

  return x - y

}

```

作者：golang才是未来
链接：https://www.jianshu.com/p/c16e49def381
来源：简书
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。