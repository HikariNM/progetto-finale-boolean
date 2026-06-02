import { useState } from 'react'
import { BrowserRouter, Route, Routes } from 'react-router-dom'
import DefaultLayout from './layouts/DefaultLayout'
import HomePage from './pages/HomePage'
import './App.css'
import BreedPage from './pages/BreedPage'
import LittersPage from './pages/LittersPage'
import AdultsPage from './pages/AdultPage'

function App() {

  return (
    <>
      <BrowserRouter>
        <Routes>
          <Route element={<DefaultLayout />}>
            <Route path="/" element={<HomePage />} />
            <Route path="/la-razza" element={<BreedPage />} />
            <Route path="/cucciolate/in-programma" element={<LittersPage type='upcoming' />} />
            <Route path="/cucciolate/passate" element={<LittersPage type='past' />} />
            <Route path="/i-nostri-cani/stalloni" element={<AdultsPage gender='male' />} />
            <Route path="/i-nostri-cani/fattrici" element={<AdultsPage gender='female' />} />
          </Route>
        </Routes>
      </BrowserRouter>
    </>
  )
}

export default App
