/// <reference types="cypress" />

describe('Prueba el formulario de contacto', () => {
    it('Prueba la pagina de contacto y el envio de emails', () => {
        cy.visit('/contacto');

        cy.get('[data-cy="heading-contacto"]').should('exist');
        cy.get('[data-cy="heading-contacto"]').invoke('text').should('equal', 'Contacto');
        cy.get('[data-cy="heading-contacto"]').invoke('text').should('not.equal', ' alguna cosa Contacto');

        cy.get('[data-cy="heading-formulario"]').should('exist');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('equal', 'Llene el Formulario de Contacto');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('not.equal', 'Contacto');

        cy.get('[data-cy="formulario-contacto"]').should('exist');

    });

    it('llena los campos del formulario', () => {
        cy.get('[data-cy="input-nombre"]').type('Enmanuel');
        cy.get('[data-cy="input-mensaje"]').type('mensaje de la casa');
        cy.get('[data-cy="input-opciones"]').type('Compra');
        cy.get('[data-cy="input-precio"]').type('123000');
        cy.get('[data-cy="forma-contacto"]').eq(1).check();
       
        cy.wait(3000);

        cy.get('[data-cy="forma-contacto"]').eq(0).check();
        cy.get('[data-cy="input-telefono"]').type('1231231234');
        cy.get('[data-cy="input-fecha"]').type('2021-12-12');
        cy.get('[data-cy="input-hora"]').type('12:30');

        cy.get('[data-cy="formulario-contacto"]').submit();

        cy.get('[data-cy="alerta-formulario"]').should('exist');
        cy.get('[data-cy="alerta-formulario"]').invoke('text').should('equal', 'Mensaje Enviado Correctamente');
        cy.get('[data-cy="alerta-formulario"]').should('have.class', 'alerta').and('have.class', 'exito').and('not.have.class', 'error');

    });
});