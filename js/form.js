const Reg = document.getElementById('regBtn');
const Login = document.getElementById('loginBtn');
const FormReg = document.getElementById('formReg');
const FormLogin = document.getElementById('formLogin');

const ControlRegForm = () => {
    let click = false;
    Reg.addEventListener('click', function(e) {
        if (!click) {
            FormReg.style.display = 'block';
            click = true;
            e.preventDefault();
        } else if (click) {
            FormReg.style.display = 'none';
            click = false;
            e.preventDefault();
        }
    });
}

const ControlLoginForm = () => {
    let click = false;
    Login.addEventListener('click', function(e) {
        if (!click) {
            FormLogin.style.display = 'block';
            click = true;
            e.preventDefault();
        } else if (click) {
            FormLogin.style.display = 'none';
            click = false;
            e.preventDefault();
        }
    });
}

const init = () => {
    ControlRegForm();
    ControlLoginForm();
}

init();