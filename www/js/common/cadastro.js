/**
 *
 * @param {HTMLFormElement} form
 * @returns
 */
function createFormSubmitSubject(form) {
    /**
     *
     * @param {Function} callback Função para chamar quando o Subject pedir
     * @returns
     */
    function subscribe(callback) {
        observers.push(callback);
        return { remove: () => unsubscribe(callback) };
    }

    function unsubscribe(callback) {
        const index = observers.indexOf(callback);
        if (index !== -1) {
            observers.splice(index, 1);
        }
    }

    function notifyAll(event) {
        for (const cb of observers) {
            cb(event);
        }
    }

    /**
     *
     * @param {SubmitEvent} event
     */
    function formSubmitHandler(event) {
        // Prevent submit
        event.preventDefault();

        // Remove custom validities (may not be needed)
        // const form = event.target;
        // const inputs = form.querySelectorAll('input');
        // for (const input of inputs) {
        //     input.setCustomValidity('');
        // }

        // Notifica os observers que houve um submit
        notifyAll(event);
    }

    const observers = [];
    const subject = {
        subscribe,
    };

    form.addEventListener('submit', formSubmitHandler);

    return subject;
}

const CadastroUtils = {
    createFormSubmitSubject,
};

export default CadastroUtils;
