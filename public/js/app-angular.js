var app = angular.module('TengriNewsAdmin' , []);

app.config(function ($interpolateProvider)
{
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

app.service('Translate' , function ()
{
    this.RuEn = function (text)
    {

        if ( text )
        {
            text = text.toLowerCase();
            var translit_table = {
                "а": "a" , "ый": "iy" , "ые": "ie" ,
                "б": "b" , "в": "v" , "г": "g" ,
                "д": "d" , "е": "e" , "ё": "yo" ,
                "ж": "zh" , "з": "z" , "и": "i" ,
                "й": "y" , "к": "k" , "л": "l" ,
                "м": "m" , "н": "n" , "о": "o" ,
                "п": "p" , "р": "r" , "с": "s" ,
                "т": "t" , "у": "u" , "ф": "f" ,
                "х": "kh" , "ц": "ts" , "ч": "ch" ,
                "ш": "sh" , "щ": "shch" , "ь": "" ,
                "ы": "y" , "ъ": "" , "э": "e" ,
                "ю": "yu" , "я": "ya" , "йо": "yo" ,
                "ї": "yi" , "і": "i" , "є": "ye" ,
                "ґ": "g"
            };

            var ignor = {
                ",": "-" , ".": "-" ,
                ":": "-" , " ": "-" , "<": "-" ,
                ">": "-" , "#": "-" , "@": "-" ,
                "?": "-" , "*": "-" , "%": "-" ,
                "(": "-" , ")": "-"
            };
            var res = '';
            for ( var i = 0; i < text.length; i++ )
            {
                if ( ignor[text[i]] )
                {
                    if ( ignor[text[i - 1]] != '-' )
                        res += ignor[text[i]];
                }
                else
                {
                    if ( (text[i].charCodeAt() >= 1072 && text[i].charCodeAt() <= 1103) )
                    {
                        res += translit_table[text[i]];
                    }
                    else
                    {
                        res += text[i];
                    }
                }
            }
            if ( res[res.length - 1] == '-' )
                res = res.substring(0 , res.length - 1);
            return res;
        }
        return '';
    };
});

app.service('messages' , function ()
{
    this.Success = function (message)
    {
        UIkit.notify(message , {status: 'success'})
    };

    this.Error = function (message)
    {
        UIkit.notify(message , {status: 'danger'})
    };
});

app.service('getUserData' , function ($http)
{
    this.Me = function (callback)
    {
        $http({
            method: 'POST' ,
            url   : '/user/get/me'//,
            // data: token
        }).then(function success(response)
        {
            callback(response.data);
        } , function error(response)
        {
        });
    };
    this.MyPage = function (callback)
    {
        $http({
            method: 'POST' ,
            url   : '/user/get/mypage'
        }).then(function success(response)
        {
            callback(response.data);
        } , function error(response)
        {
        });

    };
});

app.service('pageData' , function ($http)
{
    this.getPage = function (id)
    {
        $http({
            method: 'POST' ,
            url   : '/page/get/' + id
        }).then(function success(response)
        {
            return response;
        } , function error(response)
        {
        });
    };

    this.createPage = function (data , callback)
    {
        $http({
            method: 'POST' ,
            url   : '/page/create/' ,
            data  : data
        }).then(function success(response)
        {
            callback(true);
        } , function error(response)
        {
            callback(false);

        });
    };
});

app.service('clear' , function ($http)
{
    this.All = function (data)
    {
        $.each(data , function (key , val)
        {
            data[key] = '';
        })
    };

    this.createPage = function (data , callback)
    {
        $http({
            method: 'POST' ,
            url   : '/page/create/' ,
            data  : data
        }).then(function success(response)
        {
            callback(true);
        } , function error(response)
        {
            callback(false);

        });
    };
});

app.controller('NewsPage' , function ($scope , messages , getUserData , Translate , $http)
{
    $scope.News_list = [];
    $scope.NewsPageCount = false;
    $scope.NewsPageCountList = [];
    $scope.CurrentPage = 0;


    $scope.getNews = function (page)
    {

        if ( page )
        {
            $http({
                method: 'GET' ,
                url   : '/admin/news/page/' + page
            }).then(function success(response)
            {
                $scope.News_list = response.data.data;
                $scope.NewsPageCount = response.data.pages;
                $scope.updateListPage();
            } , function error(response)
            {
            });
        }
        else
        {
            $http({
                method: 'GET' ,
                url   : '/admin/news/page/'
            }).then(function success(response)
            {
                $scope.News_list = response.data.data;
                $scope.NewsPageCount = response.data.pages;
                $scope.updateListPage();
            } , function error(response)
            {
            });
        }

    };

    $scope.updateListPage = function ()
    {
        var temp = [];
        for ( var i = 0; i < 10; i++ )
        {
            if ( ($scope.CurrentPage + i) < $scope.NewsPageCount )
            {
                temp[i] = $scope.CurrentPage + i;
            }
        }

        $scope.NewsPageCountList = temp;
    };

    $scope.getNews();

    $scope.getPageNews = function (page)
    {
        $scope.CurrentPage = Number(page);
        $scope.getNews(page);
    }

});


app.controller('EditNews' , function ($scope , $http , $sce , $element)
{
    $scope.NewsID = false;
    $scope.NewsData = {};

    $scope.getNews = function (id)
    {
        $http({
            method: 'GET' ,
            url   : '/admin/news/get/' + id
        }).then(function success(response)
            {
                $scope.NewsData = response.data;
            } ,
            function error(response)
            {
            });
    }

    $scope.$watch('NewsID',function (e)
    {
        if (e){
            $scope.getNews(e);
        }
    })
});
