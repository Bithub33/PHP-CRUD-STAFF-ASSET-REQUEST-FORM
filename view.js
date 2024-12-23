const tabs = document.querySelectorAll('.nav-link');
const layout = document.querySelectorAll('.layout');
const main = document.getElementById('request');

const nav = document.querySelectorAll('.pp');
const sec = document.querySelectorAll('.sec');

const req = document.querySelectorAll('.container');
const btn = document.querySelectorAll('.bt');
const form = document.querySelector('form');
const cancel = document.getElementById('cancel');
const newr = document.getElementById('nr');

const int_check = document.getElementById('int');
const inf_check = document.getElementById('inf');

const int_lay = document.getElementById("internet");
const inf_lay = document.getElementById("infras");

const hard_rad = document.getElementById('hard_rad');
const soft_rad = document.getElementById('soft_rad');
const inf_rep = document.getElementById('inf_rep');
const soft_rep = document.getElementById('soft_rep');

const hard_lay = document.getElementById("infras_hard");
const soft_lay = document.getElementById("infras_soft");
const repl = document.getElementById('repl');
const soft_repl = document.getElementById('soft_repl');
const num_inp = document.getElementById('num_inp');
const err = document.getElementById('err');
const new_hard = document.getElementById('new_hard');
const new_soft = document.getElementById('soft_new');
const round = document.getElementById('round');
var count = 0;

if(inf_check.checked)
{
    inf_lay.classList.add('active');
}else{
    inf_lay.classList.remove('active');
}

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
    
});