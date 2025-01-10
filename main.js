//const tabs = document.querySelectorAll('.nav-link');
//const layout = document.querySelectorAll('.layout');
const main = document.getElementById('request');

const nav = document.querySelectorAll('.pp');
const sec = document.querySelectorAll('.sec');

const req = document.querySelectorAll('.container');
const btn = document.getElementById('btn');
const btn_user = document.getElementById('btn_user');
const form = document.querySelector('form');
const forms = document.getElementById('forms');

const dep = document.getElementById('dep');
const loc = document.getElementById('loc');
const cancel = document.getElementById('cancel');
const newr = document.getElementById('nr');
const newr_user = document.getElementById('nr_user');


const int_check = document.getElementById('int');
const inf_check = document.getElementById('inf');
const soft_rad = document.getElementById('soft_rad');

const int_lay = document.getElementById("internet");
const inf_lay = document.getElementById("infras");

const hard_rad = document.getElementById('hard_rad');
const inf_rep = document.getElementById('inf_rep');
const hard_lay = document.getElementById("infras_hard");
const soft_lay = document.getElementById("infras_soft");
const repl = document.getElementById('repl');
const num_inp = document.getElementById('num_inp');
const err = document.getElementById('err');
const err_id = document.getElementById('err_id');
const new_hard = document.getElementById('new_hard');
const new_soft = document.getElementById('soft_new');
const round = document.getElementById('round');
const int = document.getElementById('internet');
const tog = document.getElementById('icons');

const depts = [{id:1,name:'ACCOUNTS'},{id:2,name:'ADMINISTRATION'},{id:3,name:'AUDIT'},{id:4,name:'CUSTOMER SERVICE'},{id:5,name:'DIGITAL COMMERCE'},{id:6,name:'HR'},{id:7,name:'IMPORT'},{id:8,name:'IT'},{id:9,name:'MAINTENANCE'},{id:10,name:'MARKETING'},{id:11,name:'MERCHANDISE'},{id:12,name:'MIS'},{id:13,name:'OPERATIONS'},{id:14,name:'PIZZA HUT'},{id:15,name:'PROJECT'}];

const branchs = [{id:1,name:'ACCRA STORE'},{id:2,name:'ACHIMOTA'},{id:3,name:'AFIENYA'},{id:4,name:'AFLAO STORE'}, {id:5,name:'AMASAMAN'}, {id:6,name:'ARCADIA SHOP (WEST HILLS)'},{id:7,name:'ASHIAMAN BRANCH'}, {id:8,name:'ASHALEY BOTWE'}, {id:9,name:'ASHONGMAN'}, {id:10,name:'CAPECOAST STORE'}, {id:11,name:'DANSOMAN STORE'}, {id:12,name:'EAST LEGON'}, {id:13,name:'EAST LEGON-SPECIALTY'}, {id:14,name:'FRAFRAHA'}, {id:15,name:'GIO-ACHIMOTA'}, {id:16,name:'GIO-EAST LEGON'}, {id:17,name:'GIO-FRAFRAH'},{id:18,name:'GIO-LFS'}, {id:19,name:'GIO-SANTASHI'}, {id:20,name:'GIO-SPINTEX MALL'}, {id:21,name:'GIO-TAKORADI'}, {id:22,name:'GIO-WESTHILL'}, {id:23,name:'HAATSO'},{id:24,name:'HAMPTON SQUARE'},{id:82,name:'HEAD OFFICE'}, {id:25,name:'HOHOE STORE'}, {id:26,name:'HOV STORE'}, {id:27,name:'KISSIEMAN'}, {id:28,name:'KOFORIDUA STORE - II'}, {id:29,name:'KOFORIDUA-HOME'}, {id:30,name:'KUMASI 6-SUAME'}, {id:31,name:'KUMASI II STORE'},{id:32,name:'KUMASI KS4 STORE'}, {id:33,name:'KUMASI SANTASI'}, {id:34,name:'KUMASI STORE'}, {id:35,name:'KUMASI V STORE'}, {id:36,name:'LABADI'}, {id:37,name:'LAPAZ SHOP'}, {id:38,name:'MADINA STORE'}, {id:39,name:'MANKESSIM'}, {id:40,name:'MELCOM ACTIVE 8'}, {id:41,name:'MELCOM ADENTA'}, {id:42,name:'MELCOM ARCADIA'}, {id:43,name:'MELCOM ASAMANKESE'}, {id:44,name:'MELCOM ASSIN FOSU STORE'}, {id:45,name:'MELCOM BIBIANI'}, {id:46,name:'MELCOM COMMUNITY 25'}, {id:47,name:'MELCOM DANSOMAN MINI'}, {id:48,name:'MELCOM DOME MINI'},{id:49,name:'MELCOM ELECTRIC-TEMA'}, {id:50,name:'MELCOM GBAWE'}, {id:51,name:'MELCOM HOME TEMA'}, {id:52,name:'MELCOM KAS'},{id:53,name:'MELCOM KASOA MINI'}, {id:54,name:'MELCOM KASOA-II SHOP'}, {id:55,name:'MELCOM KUMASI III STORE'}, {id:56,name:'MELCOM LABONE'},{id:57,name:'MELCOM LFS'}, {id:58,name:'MELCOM MINI-2'}, {id:59,name:'MELCOM OLEBU (ABLEKUMA)'}, {id:60,name:'MELCOM SAKUMONO'}, {id:61,name:'MELCOM SEFWI-WIASO'}, {id:62,name:'MELCOM SHIASHIE'}, {id:63,name:'MELCOM TARKWA STORE'}, {id:64,name:'MELCOM TEPA'}, {id:65,name:'MELCOM-UPSA'}, {id:66,name:'MELCOM WENCHI'}, {id:67,name:'NANAKROM'}, {id:68,name:'NEW BOLGA'}, {id:69,name:'NKAWKAW STORE -NEW'}, {id:70,name:'SPINTEX NEW'}, {id:71,name:'SPINTEX NEW MALL'}, {id:72,name:'SUNYANI II STORE'}, {id:73,name:'SWEDRU STORE'}, {id:74,name:'TAFO-KUMASI 8'}, {id:75,name:'TAKORADI STORE'}, {id:76,name:'TAMALE STORE'}, {id:77,name:'TECHIMAN'}, {id:78,name:'TECHIMAN-NEW'}, {id:79,name:'TEMA PLUS STORE'}, {id:80,name:'WA SHOP'}, {id:81,name:'WEIJA SHOP'}];

var count = 0;
date();
index();


function date(){
    const today = new Date().toISOString().split('T')[0];
    if(document.getElementById('date') != null)
    {
        const date = document.getElementById('date').value = today;

        depts.forEach(item =>{
            const opt = document.createElement('option');
            opt.value = item.name;
            opt.textContent = item.name;
            dep.appendChild(opt);
        });

        branchs.forEach(item =>{
            const opt = document.createElement('option');
            opt.value = item.name;
            opt.textContent = item.name;
            loc.appendChild(opt);
        });

        inf_check.addEventListener("change",()=>{
            if(inf_check.checked)
            {
                inf_lay.classList.add('active');
            }else{
                inf_lay.classList.remove('active');
            }
        });
        
        hard_rad.addEventListener("change",()=>{
            if(hard_rad.checked)
            {
                soft_lay.classList.remove('active');
                const inputs = soft_lay.querySelectorAll('input');
                const span = soft_lay.querySelectorAll('span');
                inputs.forEach((input,index) => {
                    if(input.type === 'text' || input.type === 'number')
                    {
                        input.value = '';

                    }else if(input.type === 'checkbox')
                    {
                        input.checked = false;
                        
                    }
                });
                span.forEach(spans =>{
                    spans.style.display = 'none';
                });
                hard_lay.classList.add('active');
                
            }
        });
        
        soft_rad.addEventListener('change',()=>{
            if(soft_rad.checked)
            {
                hard_lay.classList.remove('active');
                const inputs = hard_lay.querySelectorAll('input');
                const span = hard_lay.querySelectorAll('span');
                const input = hard_lay.querySelector('textarea').value ='';
                inputs.forEach((input,index) => {
                    if(input.type === 'text' || input.type === 'number')
                    {
                        input.value = '';

                    }else if(input.type === 'checkbox')
                    {
                        input.checked = false;
                        repl.classList.remove('active');
                    }
                });
                span.forEach(spans =>{
                    spans.style.display = 'none';
                });
                soft_lay.classList.add('active');
                
            }
        });
        
        inf_rep.addEventListener('change',()=>{
            if(inf_rep.checked)
            {
                repl.classList.add('active');

            }else{
                repl.classList.remove('active');
            }
        });

        int_check.addEventListener('change',()=>{
            if(int_check.checked)
            {
                int.style.display = 'block';
            }else{
                int.style.display = 'none';
            }
        });
        
        num_inp.addEventListener('input',() =>{
            num_inp.value = num_inp.value.replace(/[^0-9]/g, '');
        });

        form.addEventListener('submit', (e) =>{
            if(num_inp.value.length !== 10)
            {
                e.preventDefault();
                err.style.display = 'block';
                
            }else{
                err.style.display = 'none';
                
            }

            if(inf_check.checked)
            {
                if(soft_rad.checked)
                {
                    const inputs = new_soft.querySelectorAll('input');
                    const span_new = new_soft.querySelectorAll('span');
                    inputs.forEach((input,index) => {
                        if(input.value === '')
                        {
                            e.preventDefault();
                            span_new[index].style.display = 'block';
                            count++;
    
                        }else
                        {
                            span_new[index].style.display = 'none';
                            
                            
                        }
                    });
                    
                }
    
                if(hard_rad.checked)
                {
                    const inputs = new_hard.querySelectorAll('input');
                    const inputs_repl = repl.querySelectorAll('input');
                    const span_repl = repl.querySelectorAll('span');
                    const span_new = new_hard.querySelectorAll('span');
                    inputs.forEach((input,index) => {
                        if(input.value === '')
                        {
                            e.preventDefault();
                            span_new[index].style.display = 'block';
                            
    
                        }else
                        {
                            span_new[index].style.display = 'none';
                            
                        }
                    });
    
                }

                if(inf_rep.checked)
                {
                    inputs_repl.forEach((input,index) => {
                        if(input.value === '')
                        {
                            e.preventDefault();
                            span_repl[index].style.display = 'block';
                            
    
                        }else
                        {
                            span_repl[index].style.display = 'none';
                            
                        }
                    });

                }
            }

            submit(e);

        });

        btn.addEventListener('click',()=>{
        
            btn.style.display = 'none';
            newr.classList.add('active');
        });

    }
    
}



/*tabs.forEach((tab,index)=>{

    tab.addEventListener('click',(e)=>{
        
        layout.forEach(layout=>(layout.classList.remove('active'))); 
        layout[index].classList.add('active');
        
    });
});*/

nav.forEach((navs,index)=>{

    navs.addEventListener('click',(e)=>{
        
        req.forEach(req=>(req.classList.remove('active'))); 
        req[index].classList.add('active');

        nav.forEach(nav=>(nav.classList.remove('active'))); 
        nav[index].classList.add('active');

        sec.forEach(sec=>(sec.classList.remove('active'))); 
        sec[index].classList.add('active');

        if(nav.length > 1){

            localStorage.setItem('index',index);
        }

        form.reset();
    });
});

function index(){
    let index = localStorage.getItem('index');
    if(!index){

        localStorage.setItem('index', 0);
        location.reload();
        
    }else{
        
        if(req[index] && req[index].classList){

            req[index].classList.add('active');

            nav[index].classList.add('active');

            sec[index].classList.add('active');

            btn_user.addEventListener('click',()=>{
        
                btn_user.style.display = 'none';
                newr_user.classList.add('active');
            });

            forms.addEventListener('submit',(e)=>{

                const pass = document.getElementById('pass').value;
                const con_pass = document.getElementById('pass_con').value;
                const span = document.getElementById('err');
            
                if(pass !== con_pass){
            
                    e.preventDefault();
                    span.style.display = 'block';
            
                }else{
            
                    span.style.display = 'none';
                }
            
            });
            
        }else{
            req[0].classList.add('active');
 
            nav[0].classList.add('active');

            sec[0].classList.add('active');
        }

    }
}

function submit(e)
{
    if(confirm('Request cannot be edited after it is sent. Please confirm'))
    {
        //window.location.href = "create.php";
        const load = getElementById('load');
        load.style.display = 'block';
        
    }else{
        e.preventDefault();
    }

}

function exports_staff(){
    window.location.href = "export_staff.php";
}

function exports_imp(){
    window.location.href = "export_imp.php";
}

function exports_aud(){
    window.location.href = "export_aud.php";
}

function exports_users(){
    window.location.href = "export_users.php";
}

document.getElementById('logout').addEventListener('click',()=>{
    localStorage.setItem('index',0);
});


/*tog.addEventListener("click",function(){
    document.querySelector("#side_bar").classList.toggle("active");
    document.querySelector("#request").classList.toggle("expand");
}); */





