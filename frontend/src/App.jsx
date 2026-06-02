import { useState } from 'react'
import { BrowserRouter, Route, Routes } from 'react-router-dom'
import './App.css'
import DefaultLayout from './layouts/DefaultLayout'
import HomePage from './pages/HomePage'
import BreedPage from './pages/BreedPage'
import LittersPage from './pages/LittersPage'
import AdultsPage from './pages/AdultPage'
import AdultDetailPage from './pages/AdultDetailPage'
import LitterDetailPage from './pages/LitterDetailPage'

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
            <Route path="/cucciolate/:id" element={<LitterDetailPage />} />
            <Route path="/i-nostri-cani/stalloni" element={<AdultsPage gender='male' />} />
            <Route path="/i-nostri-cani/fattrici" element={<AdultsPage gender='female' />} />
            <Route path="/i-nostri-cani/:id" element={<AdultDetailPage />} />
          </Route>
        </Routes>
      </BrowserRouter>
    </>
  )
}

export default App
